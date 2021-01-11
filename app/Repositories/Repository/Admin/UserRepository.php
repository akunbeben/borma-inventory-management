<?php

namespace App\Repositories\Repository\Admin;

use App\Models\User;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements IUserRepository
{
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $users = $this->model;

    if ($relations) $users = $users->with($relations);

    if ($searchQuery) {
      $users = $users
                ->where('name', 'ILIKE', '%' . $searchQuery . '%')
                ->orWhere('npk', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $users->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function save(array $attributes)
  {
    $attributesBind = $this->dataStoreBinding($attributes);

    $result = $this->model->create($attributesBind);

    return $result;
  }

  public function getByUuid(string $uuid, ?array $relations)
  {
    $user = $this->model->where('id', $uuid);

    $this->checkIfExist($user);

    if ($relations) $user = $user->with($relations);

    return $user->first();
  }

  public function delete(string $uuid)
  {
    $this->getByUuid($uuid, null)->delete();
  }

  private function dataStoreBinding(array $attributes)
  {
    $attributes['id'] = Str::uuid();
    $attributes['password'] = bcrypt('12345678');
    $attributes['division_id'] = $attributes['division'];

    unset($attributes['division']);

    return $attributes;
  }
}