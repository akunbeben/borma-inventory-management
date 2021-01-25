<?php

namespace App\Repositories\Repository\User;

use App\Models\Inventory;
use App\Models\StockOutBody;
use App\Models\StockOutHeader;
use App\Repositories\Interfaces\User\IStockOutRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    $data = $this->headerModel;

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->where('order_id', 'ILIKE', '%' . $searchQuery . '%');

    return $data->orderBy('status_id', 'asc')->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getStockOutType()
  {
    return DB::table('stock_out_type')->get();
  }

  public function create(array $attributes)
  {
    $id = Str::uuid();
    $orderId = explode('-', $id);

    $attribute = [
      'id' => $id,
      'order_id' => $attributes['order_id'],
      'stock_out_type_id' => (int) $attributes['stock_out_type'],
      'status_id' => self::DRAFT
    ];

    $data = $this->headerModel->create($attribute);

    return $data;
  }

  public function getByUuid(string $uuid, ?array $relations)
  {
    $data = $this->headerModel->where('id', $uuid);

    $this->checkIfExist($data);

    if ($relations) $data = $data->with($relations);

    return $data->first();
  }

  public function appendChild(string $uuid, array $attributes)
  {
    $parent = $this->getByUuid($uuid, null);

    $attributesMap = $this->mapChild($attributes);

    $stock = $this->inventory->where('product_id', $attributesMap['product_id'])->first();

    if ($stock->actual_stock - $attributesMap['quantity'] < 0) {
      return null;
    }

    $child = $parent->body()->create($attributesMap);

    return $child;
  }

  public function submit(string $uuid)
  {
    $data = $this->getByUuid($uuid, null);
    $data->status_id = self::PENDING;

    $data->update();

    return $data;
  }

  public function removeChild(string $uuid)
  {
    $this->getChild($uuid)->delete();
  }

  private function mapChild(array $attributes)
  {
    $attributes['id'] = Str::uuid();

    return $attributes;
  }

  private function getChild(string $uuid)
  {
    return $this->bodyModel->where('id', $uuid)->first();
  }
}