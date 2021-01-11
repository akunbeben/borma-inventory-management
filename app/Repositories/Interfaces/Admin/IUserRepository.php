<?php

namespace App\Repositories\Interfaces\Admin;

interface IUserRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searcQuery);
  public function save(array $attributes);
  public function getByUuid(string $uuid, ?array $relations);
  public function delete(string $uuid);
  public function passwordReset(string $uuid);
  public function updates(string $uuid, array $attributes);
}