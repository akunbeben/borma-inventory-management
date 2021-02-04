<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Inventory;
use App\Models\Report;
use App\Repositories\Repository\BaseRepository;
use App\Repositories\Interfaces\Admin\IReportRepository;

use Illuminate\Support\Str;

class ReportRepository extends BaseRepository implements IReportRepository
{
  protected $model;
  protected $inventory;
  private const INVENTORY = 1;
  private const STOCK_IN = 2;
  private const STOCK_OUT = 3;
  private const PROMOTION = 4;

  public function __construct(Report $model, Inventory $inventory)
  {
    $this->model = $model;
    $this->inventory = $inventory;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery, int $documentType)
  {
    $data = $this->model->where('document_type_id', $documentType);

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->where('document_number', 'ILIKE', '%' . $searchQuery . '%');

    return $data->orderBy('created_at', 'ASC')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function create(array $attributes, string $createdBy, int $documentType)
  {
    $mapAttributes = $this->mapParent($attributes, $createdBy, $documentType);

    $data = $this->model->create($mapAttributes);

    // if ($documentType == self::INVENTORY) $data->stock()->create($this->mapStock($attributes));

    return $data;
  }

  private function mapParent(array $attributes, string $createdBy, int $documentType)
  {
    $counter = $this->model->count() + 1;
    
    $attributes['id'] = Str::orderedUuid();
    $attributes['created_by'] = $createdBy;
    $attributes['document_number'] = 'DOC/STOCK/' . date('my/d', time()) . '/' . $counter;
    $attributes['document_type_id'] = $documentType;

    return $attributes;
  }
  
  private function mapStock(array $attributes)
  {

  }
}