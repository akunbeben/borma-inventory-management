<?php

namespace App\Repositories\Repository\Admin;

use App\Models\User;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Repository\BaseRepository;

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

    if ($searchQuery) $users = $users->where('name', 'like', '%' . $searchQuery . '%');

    return $users->orderBy('created_at', 'desc')->paginate($perPage)->appends($searchQuery);
  }
}