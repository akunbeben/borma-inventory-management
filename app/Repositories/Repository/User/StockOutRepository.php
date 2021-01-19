<?php

namespace App\Repositories\Repository\User;

use App\Models\Inventory;
use App\Models\StockOutBody;
use App\Models\StockOutHeader;
use App\Repositories\Interfaces\User\IStockOutRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

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

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $data = $this->headerModel;

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->where('order_id', 'ILIKE', '%' . $searchQuery . '%');

    return $data->orderBy('status_id', 'asc')->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getStockOutType()
  {
    return DB::table('stock_out_type')->get();
  }
}