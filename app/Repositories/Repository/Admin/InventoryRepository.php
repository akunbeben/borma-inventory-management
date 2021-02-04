<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Repositories\Interfaces\Admin\IInventoryRepository;
use App\Repositories\Repository\BaseRepository;

class InventoryRepository extends BaseRepository implements IInventoryRepository
{
  protected $model;

  public function __construct(Inventory $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    if ($relations) $this->model = $this->model->with($relations);

    if ($searchQuery) {
      $this->model = $this->model->whereHas('products', function($query) use ($searchQuery) {
        $query->where('product_name', 'ILIKE', '%' . $searchQuery . '%');
      });
    }

    return $this->model->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function search(string $startDate, string $endDate, ?array $relations)
  {
    $this->model = $this->model->where('created_at', '>', $startDate)->where('created_at', '<', $endDate);

    if ($relations) $this->model = $this->model->with($relations);

    return $this->model;
  }

  public function get()
  {
    return $this->model->get();
  }
}