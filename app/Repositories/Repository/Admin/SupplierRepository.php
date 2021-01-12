<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Supplier;
use App\Repositories\Interfaces\Admin\ISupplierRepository;
use App\Repositories\Repository\BaseRepository;

use Illuminate\Support\Str;

class SupplierRepository extends BaseRepository implements ISupplierRepository
{
  protected $model;
  
  public function __construct(Supplier $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $suppliers = $this->model;

    if ($relations) $suppliers = $suppliers->with($relations);

    if ($searchQuery) {
      $suppliers = $suppliers
                    ->where('supplier_name', 'ILIKE', '%' . $searchQuery . '%')
                    ->orWhere('supplier_code', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $suppliers->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getByUuid(string $uuid, ?array $relations)
  {
    $supplier = $this->model->where('id', $uuid);

    $this->checkIfExist($supplier);

    if ($relations) $supplier = $supplier->with($relations);

    return $supplier->first();
  }

  public function save(array $attributes, string $createBy)
  {
    $acceptedAttributes = $this->objectStoreMapping($attributes, $createBy);

    $supplier = $this->model->create($acceptedAttributes);

    return $supplier;
  }

  public function updates(string $uuid, array $attributes)
  {
    $supplier = $this->getByUuid($uuid, null);

    $supplier->update($attributes);

    return $supplier;
  }

  public function delete(string $uuid)
  {
    $this->getByUuid($uuid, null)->delete();
  }

  private function objectStoreMapping(array $attributes, string $createBy)
  {
    $attributes['id'] = Str::uuid();
    $attributes['supplier_code'] = 'SPR-' . mt_rand(10000, 99999);
    $attributes['created_by'] = $createBy;
    
    return $attributes;
  }
}