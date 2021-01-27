<?php

namespace App\Repositories\Repository\Admin;

use App\Models\UpProduct;
use App\Repositories\Interfaces\Admin\IUpProductRepository;
use App\Repositories\Repository\BaseRepository;

class UpProductRepository extends BaseRepository implements IUpProductRepository
{
  protected $model;

  public function __construct(UpProduct $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations = null, ?string $searchQuery = null)
  {
    $data = $this->model;

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->whereHas('product', function($query) use ($searchQuery) {
      $query->where('product_name', 'ILIKE', '%' . $searchQuery . '%')
        ->orWhere('product_barcode', 'ILIKE', '%' . $searchQuery . '%')
        ->orWhere('product_plu', 'ILIKE', '%' . $searchQuery . '%');
    });

    return $data->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }
}