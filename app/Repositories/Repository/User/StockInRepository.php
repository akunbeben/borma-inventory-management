<?php
namespace App\Repositories\Repository\User;

use App\Models\Inventory;
use App\Models\StockInBody;
use App\Models\StockInHeader;
use App\Repositories\Interfaces\User\IStockInRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class StockInRepository extends BaseRepository implements IStockInRepository
{
  protected $model;
  protected $stockInBody;
  protected $inventory;

  public function __construct(StockInHeader $model, StockInBody $stockInBody, Inventory $inventory)
  {
    $this->model = $model;
    $this->stockInBody = $stockInBody;
    $this->inventory = $inventory;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $stockInData = $this->model;

    if ($relations) $stockInData = $stockInData->with($relations);

    if ($searchQuery) {
      $stockInData = $stockInData->where('order_id', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $stockInData->orderBy('status_id', 'asc')->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function createOrderStockIn(array $attributes)
  {
    $id = Str::uuid();
    $order_id = explode('-', $id);

    $attribute = [
      'id' => $id,
      'order_id' => 'RF-' . strtoupper($order_id[0]),
      'stock_in_type_id' => (int) $attributes['stock_in_type'],
      'status_id' => 1
    ];

    $stockIn = $this->model->create($attribute);

    return $stockIn;
  }

  public function getStockInDetail(string $uuid, ?array $relations)
  {
    $stockIn = $this->model->where('id', $uuid);

    $this->checkIfExist($stockIn);

    if ($relations) $stockIn = $stockIn->with($relations);

    return $stockIn->first();
  }

  public function storeOrder(string $uuid, array $attributes)
  {
    $data = $this->getStockInDetail($uuid, null);

    $mappedAttributes = $this->objectBodyMapping($attributes);

    $body = $data->body()->create($mappedAttributes);

    return $body;
  }

  public function deleteBody(string $uuid)
  {
    $this->getBody($uuid)->delete();
  }

  public function submitBody(array $attributes)
  {
    $data = $this->mappingToInventory($attributes);

    foreach ($data as $stockIn) {
      $product = $this->inventory->where('product_id', $stockIn['product_id'])->first();
      $product->actual_stock = $product->actual_stock + $stockIn['quantity'];
      $product->update($stockIn);
    }

    return $data;
  }

  public function submitOrder(string $uuid)
  {
    $stockIn = $this->getStockInDetail($uuid, null);
    $stockIn->status_id = 2;

    $stockIn->update();

    return $stockIn;
  }

  private function mappingToInventory(array $attributes)
  {
    $data = [];
    foreach($attributes as $product)
    {
      $data[] = [
        'product_id' => $product['product']['id'],
        'quantity' => $product['quantity'],
        'expired_date' => date('Y-m-d', strtotime($product['expired_date'])),
        'information' => $product['information'],
        'date_stock_in' => date('Y-m-d H:i:s', time())
      ];
    }

    return $data;
  }

  public function getStockInType()
  {
    return DB::table('stock_in_type')->get();
  }

  private function getBody(string $uuid)
  {
    return $this->stockInBody->where('id', $uuid)->first();
  }

  private function objectBodyMapping(array $attributes)
  {
    $attributes['id'] = Str::uuid();
    return $attributes;
  }
}