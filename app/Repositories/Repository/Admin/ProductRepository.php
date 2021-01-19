<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Product;
use App\Repositories\Interfaces\Admin\IProductRepository;
use App\Repositories\Repository\BaseRepository;

use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements IProductRepository
{
  protected $model;

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

  public function getAvailableProducts(?array $stockInData)
  {
    $data = array();

    foreach($stockInData as $product)
    {
      $data[] = $product['product_id'];
    }

    $products = $this->model->whereDoesntHave('stockInBody', function($query) use ($data) {
      $query->whereIn('product_id', $data);
    })->get();

    return $products;
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

    $product->update($attributes);

    return $product;
  }

  private function childMapping(array $attributes)
  {
    $childAttribute = [
      'product_id' => $attributes['id'],
      'actual_stock' => $attributes['product_initial_quantity'],
      'date_stock_in' => date('Y/m/d H:i:s', time()),
      'expired_date' => $attributes['product_expired_date'],
      'information' => 'Initial Stock',
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

    return $attributes;
  }
}