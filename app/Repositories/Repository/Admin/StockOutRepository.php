<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Models\StockOutBody;
use App\Models\StockOutHeader;
use App\Repositories\Interfaces\Admin\IStockOutRepository;
use App\Repositories\Repository\BaseRepository;

class StockOutRepository extends BaseRepository implements IStockOutRepository
{
  protected $headerModel;
  protected $bodyModel;
  protected $inventory;
  protected const DRAFT = 1;
  protected const PENDING = 2;
  protected const APPROVED = 3;
  protected const REJECTED = 4;

  public function __construct(StockOutHeader $headerModel, StockOutBody $bodyModel, Inventory $inventory)
  {
    $this->headerModel = $headerModel;
    $this->bodyModel = $bodyModel;
    $this->inventory = $inventory;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $data = $this->headerModel->where('status_id', '!=', self::DRAFT);

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) {
      $data = $data->where('order_id', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $data->orderBy('status_id', 'asc')->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getByUuid(string $uuid, ?array $relations)
  {
    $data = $this->headerModel->where('id', $uuid);

    $this->checkIfExist($data);

    if ($relations) $data = $data->with($relations);

    return $data->first();
  }

  public function approve(string $uuid)
  {
    $data = $this->getByUuid($uuid, null);
    $data->status_id = self::APPROVED;

    $data->update();

    $this->submitChild($data->body->toArray());

    return $data;
  }

  public function reject(string $uuid)
  {
    $data = $this->getByUuid($uuid, null);
    $data->status_id = self::REJECTED;

    $data->update();

    return $data;
  }

  private function submitChild(array $attributes)
  {
    $data = $this->mapToInventory($attributes);

    foreach ($data as $stock) {
      $product = $this->inventory->where('product_id', $stock['product_id'])->first();
      $product->actual_stock = $product->actual_stock - $stock['quantity'];
      $product->update($stock);
    }

    return $data;
  }

  private function mapToInventory(array $attributes)
  {
    $data = [];

    foreach($attributes as $product)
    {
      $data[] = [
        'product_id' => $product['product_id'],
        'quantity' => $product['quantity'],
        'information' => $product['information'],
        'date_stock_out' => date('Y-m-d H:i:s', time())
      ];
    }

    return $data;
  }
}