<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Repositories\Interfaces\Admin\IInventoryRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class InventoryRepository extends BaseRepository implements IInventoryRepository
{
  protected $model;

  public function __construct(Inventory $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $inventory = $this->model;

    if ($relations) $inventory = $inventory->with($relations);

    if ($searchQuery) {
      $inventory = $inventory->whereHas('products', function($query) use ($searchQuery) {
        $query->where('product_name', 'ILIKE', '%' . $searchQuery . '%');
      });
    }

    return $inventory->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }
}