<?php

namespace App\Repositories\Repository\Admin;

use App\Models\NewProduct;
use App\Repositories\Interfaces\Admin\INewProductRepository;
use App\Repositories\Repository\BaseRepository;

class NewProductRepository extends BaseRepository implements INewProductRepository
{
  protected $model;

  public function __construct(NewProduct $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $data = $this->model;

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->where('product_name', 'ILIKE', '%' . $searchQuery . '%');

    return $data->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }
}