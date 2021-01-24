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
    $products = $this->model->with('type');

    if ($relations) $products = $products->with($relations);

    if ($searchQuery) {
      $products = $products
                    ->where('product_name', 'ILIKE', '%' . $searchQuery . '%')
                    ->orWhere('product_plu', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $products->where('product_type', $productType)->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getAvailableProducts(?array $data, string $type)
  {
    $dataToArray = array();

    foreach($data as $product)
    {
      $dataToArray[] = $product['product_id'];
    }

    $products = $this->model;

    if ($type == 'stockOutBody') {
      $products = $products->whereHas('inventory', function($query) {
        $query->where('actual_stock', '<>', 0);
      });
    }

    return $products->whereNotIn('id', $dataToArray)->get();
  }

  public function save(array $attributes, int $productType)
  {
    $mappedAttributes = $this->objectStoreMapping($attributes, $productType);
    $product = $this->model->create($mappedAttributes);
    $inventoryData = $this->childMapping($mappedAttributes);

    if ($product) $product->inventory()->create($inventoryData);

    return $product;
  }

  public function getByUuid(string $uuid, ?array $relations, ?int $productType)
  {
    $product = $this->model->where('id', $uuid)->where('product_type', $productType);

    $this->checkIfExist($product);

    if ($relations) $product = $product->with($relations);

    return $product->first();
  }

  public function updates(array $attributes, string $uuid, int $productType)
  {
    $product = $this->model->where('id', $uuid);

    $attribute = $this->objectUpdateMapping($attributes);

    $product->update($attribute);

    return $product;
  }

  private function childMapping(array $attributes)
  {
    $childAttribute = [
      'product_id' => $attributes['id'],
      'actual_stock' => $attributes['product_initial_quantity'],
      'date_stock_in' => date('Y/m/d H:i:s', time()),
      'expired_date' => $attributes['product_expired_date'],
      'information' => self::INITIAL_INFORMATION,
    ];

    return $childAttribute;
  }

  public function delete(string $uuid, int $productType)
  {
    $this->getByUuid($uuid, null, $productType)->delete();
  }

  private function objectStoreMapping(array $attributes, int $productType)
  {
    $attributes['id'] = Str::uuid();
    $attributes['product_type'] = $productType;
    $attributes['min'] = $attributes['min'] * 24;
    $attributes['max'] = $attributes['max'] * 24;

    return $attributes;
  }

  private function objectUpdateMapping(array $attributes)
  {
    $attributes['min'] = $attributes['min'] * 24;
    $attributes['max'] = $attributes['max'] * 24;

    return $attributes;
  }
}