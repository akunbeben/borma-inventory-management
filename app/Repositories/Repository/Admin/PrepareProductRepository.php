<?php

namespace App\Repositories\Repository\Admin;

use App\Models\PrepareProduct;
use App\Repositories\Interfaces\Admin\IPrepareProductRepository;
use App\Repositories\Repository\BaseRepository;

class PrepareProductRepository extends BaseRepository implements IPrepareProductRepository
{
  protected $model;

  public function __construct(PrepareProduct $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
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