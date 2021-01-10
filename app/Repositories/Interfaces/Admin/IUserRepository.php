<?php

namespace App\Repositories\Interfaces\Admin;

interface IUserRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searcQuery);
}