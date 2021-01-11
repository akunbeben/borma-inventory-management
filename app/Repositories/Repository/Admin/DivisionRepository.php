<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Division;
use App\Repositories\Interfaces\Admin\IDivisionRepository;
use App\Repositories\Repository\BaseRepository;

class DivisionRepository extends BaseRepository implements IDivisionRepository
{
  protected $model;

  public function __construct(Division $model)
  {
    $this->model = $model;
  }
}