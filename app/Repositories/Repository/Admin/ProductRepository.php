<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Product;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Repository\BaseRepository;

use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements IProductRepository
{
  protected $model;
  protected const INITIAL_INFORMATION = 'Initial Stock';

  public function __construct(Product $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery, int $productType)
  {
    $this->model = $this->model->with('type');

    if ($relations) $this->model = $this->model->with($relations);

    if ($searchQuery) {
      $this->model
        ->where('product_name', 'ILIKE', '%' . $searchQuery . '%')
        ->orWhere('product_plu', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $this->model->where('product_type', $productType)
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends(['search' => $searchQuery]);
  }

  public function getAvailableProducts(?array $data, string $type)
  {
    $dataToArray = array();

    foreach($data as $product)
    {
      $dataToArray[] = $product['product_id'];
    }

    $this->model = $this->model;

    if ($type == 'stockOutBody') {
      $this->model = $this->model->whereHas('inventory', function($query) {
        $query->where('actual_stock', '<>', 0);
      });
    }

    return $this->model->whereNotIn('id', $dataToArray)->get();
  }

  public function getUnselectedProduct(string $table, string $column, ?array $clause = null)
  {
    $clauseToArray = array();

    foreach($clause as $filter)
    {
      $dataToArray[] = $filter['product_id'];
    }

    $data = $this->model;

    return $data->whereNotIn('id', $clauseToArray)->get();
  }

  public function save(array $attributes, int $productType, string $userId)
  {
    $mappedAttributes = $this->objectStoreMapping($attributes, $productType, $userId);

    $inventoryData = $this->childMapping($mappedAttributes, $userId);
    
    $this->model = $this->model->create($mappedAttributes);
    
    $this->model->inventory()->create($inventoryData);

    return $this->model;
  }

  public function getByUuid(string $uuid, ?array $relations, ?int $productType)
  {
    $this->model = $this->model->where('id', $uuid)->where('product_type', $productType);

    $this->checkIfExist($this->model);

    if ($relations) $this->model = $this->model->with($relations);

    return $this->model->first();
  }

  public function updates(array $attributes, string $uuid, int $productType)
  {
    $attribute = $this->objectUpdateMapping($attributes);

    $this->model = $this->getByUuid($uuid, null, $productType)->update($attribute);

    return $this->model;
  }

  public function delete(string $uuid, int $productType)
  {
    $this->getByUuid($uuid, null, $productType)->delete();
  }

  public function get()
  {
    return $this->model->get();
  }

  private function childMapping(array $attributes, string $userId)
  {
    $childAttribute = [
      'product_id' => $attributes['id'],
      'actual_stock' => $attributes['product_initial_quantity'],
      'date_stock_in' => date('Y/m/d H:i:s', time()),
      'expired_date' => $attributes['product_expired_date'],
      'information' => self::INITIAL_INFORMATION,
      'created_by' => $userId
    ];

    return $childAttribute;
  }

  private function objectStoreMapping(array $attributes, int $productType, string $userId)
  {
    $attributes['id'] = Str::uuid();
    $attributes['product_type'] = $productType;
    $attributes['min'] = $attributes['min'] * 24;
    $attributes['max'] = $attributes['max'] * 24;
    $attributes['created_by'] = $userId;

    return $attributes;
  }

  private function objectUpdateMapping(array $attributes)
  {
    $attributes['min'] = $attributes['min'] * 24;
    $attributes['max'] = $attributes['max'] * 24;

    return $attributes;
  }
}