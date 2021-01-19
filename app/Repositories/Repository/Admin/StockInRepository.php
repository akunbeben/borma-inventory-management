<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Models\StockInHeader;
use App\Repositories\Interfaces\Admin\IStockInRepository;
use App\Repositories\Repository\BaseRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockInRepository extends BaseRepository implements IStockInRepository
{
  protected $model;
  protected $inventory;
  const DRAFT = 1;
  const PENDING = 2;
  const APPROVED = 3;
  const REJECTED = 4;

  public function __construct(StockInHeader $model, Inventory $inventory)
  {
    $this->model = $model;
    $this->inventory = $inventory;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $stockInData = $this->model->where('status_id', '!=', self::DRAFT);

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

  public function getStockInType()
  {
    return DB::table('stock_in_type')->get();
  }

  public function approve(string $uuid)
  {
    $data = $this->getStockInDetail($uuid, ['body.product']);
    $data->status_id = self::APPROVED;
    $data->update();

    $this->submitStockIn($data->body->toArray());

    return $data;
  }

  public function reject(string $uuid)
  {
    $data = $this->getStockInDetail($uuid, null);
    $data->status_id = self::REJECTED;

    $data->update();

    return $data;
  }

  private function submitStockIn(array $attributes)
  {
    $data = $this->mapToInventory($attributes);

    foreach ($data as $stockIn) {
      $product = $this->inventory->where('product_id', $stockIn['product_id'])->first();
      $product->actual_stock = $product->actual_stock + $stockIn['quantity'];
      $product->update($stockIn);
    }

    return $data;
  }

  private function mapToInventory(array $attributes)
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
}