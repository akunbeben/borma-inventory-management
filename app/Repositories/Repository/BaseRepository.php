<?php

namespace App\Repositories\Repository;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
  protected $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function getAll()
  {
    return $this->model->all();
  }

  public function getById(int $id)
  {
    return $this->model->findOrFail($id);
  }

  public function store(array $attributes)
  {
    return $this->model->create($attributes);
  }

  public function update(int $id, array $attributes)
  {
    $data = $this->getById($id)->update($attributes);

    return $data;
  }

  public function destroy(int $id)
  {
    $this->getById($id)->delete();
  }

  public function checkIfExist($data)
  {
    if ($data->count() < 1) return abort(401);

    return $data;
  }
}