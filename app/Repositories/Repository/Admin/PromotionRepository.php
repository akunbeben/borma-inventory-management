<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Promotion;
use App\Repositories\Interfaces\Admin\IPromotionRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Str;

class PromotionRepository extends BaseRepository implements IPromotionRepository
{
  protected $model;

  public function __construct(Promotion $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $data = $this->model;

    if ($relations) $data = $data->with($relations);

    if ($searchQuery) $data = $data->whereHas('product', function($query) use ($searchQuery) {
      $query->where('product_name', $searchQuery);
    });

    return $data->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function getByUuid(string $uuid, ?array $relations)
  {
    $data = $this->model->where('id', $uuid);

    $this->checkIfExist($data);

    if ($relations) $data = $data->with($relations);

    return $data->first();
  }

  public function save(array $attributes)
  {
    $data = $this->mapToEntity($attributes);

    $entity = $this->model->create($data);

    return $entity;
  }

  public function updates(string $uuid, array $attributes)
  {
    $data = $this->getByUuid($uuid, null);

    $data->update($attributes);

    return $data;
  }

  public function delete(string $uuid)
  {
    $this->getByUuid($uuid, null)->delete();
  }

  public function getLatest()
  {
    return $this->model->orderBy('created_at', 'desc')->with('product')->limit(6)->get();
  }

  private function mapToEntity(array $attributes)
  {
    $attributes['id'] = Str::uuid();

    return $attributes;
  }
}