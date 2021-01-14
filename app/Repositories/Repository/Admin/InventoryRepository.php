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
}