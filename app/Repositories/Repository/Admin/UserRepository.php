<?php

namespace App\Repositories\Repository\Admin;

use App\Models\User;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Repository\BaseRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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
    $attributesBind = $this->objectStoreMapping($attributes);

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

  public function passwordReset(string $uuid)
  {
    $user = $this->getByUuid($uuid, null);
    $user->password = bcrypt('12345678');

    $user->save();

    return $user;
  }

  public function updates(string $uuid, array $attributes)
  {
    $mappedAttributes = $this->objectUpdateMapping($attributes);
    $user = $this->getByUuid($uuid, null);

    $user->update($mappedAttributes);

    return $user;
  }

  private function objectUpdateMapping(array $attributes)
  {
    $attributes['division_id'] = $attributes['division'];

    $accepted = Arr::only($attributes, ['name', 'division_id']);

    return $accepted;
  }

  private function objectStoreMapping(array $attributes)
  {
    $attributes['id'] = Str::uuid();
    $attributes['password'] = bcrypt('12345678');
    $attributes['division_id'] = $attributes['division'];

    unset($attributes['division']);

    return $attributes;
  }
}