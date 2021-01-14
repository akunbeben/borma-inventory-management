<?php

namespace App\Repositories\Repository\Admin;

use App\Models\ProductType;
use App\Repositories\Interfaces\Admin\IProductTypeRepository;
use App\Repositories\Repository\BaseRepository;

class ProductTypeRepository extends BaseRepository implements IProductTypeRepository
{
  protected $model;

  public function __construct(ProductType $model)
  {
    $this->model = $model;
  }
}