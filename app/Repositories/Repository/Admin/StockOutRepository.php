<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Models\StockOutBody;
use App\Models\StockOutHeader;
use App\Repositories\Interfaces\Admin\IStockOutRepository;
use App\Repositories\Repository\BaseRepository;

class StockOutRepository extends BaseRepository implements IStockOutRepository
{
  protected $headerModel;
  protected $bodyModel;
  protected $inventory;
  protected const DRAFT = 1;
  protected const PENDING = 2;
  protected const APPROVED = 3;
  protected const REJECTED = 4;

  public function __construct(StockOutHeader $headerModel, StockOutBody $bodyModel, Inventory $inventory)
  {
    $this->headerModel = $headerModel;
    $this->bodyModel = $bodyModel;
    $this->inventory = $inventory;
  }
}