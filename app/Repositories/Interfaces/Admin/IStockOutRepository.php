<?php

namespace App\Repositories\Interfaces\Admin;

interface IStockOutRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function getByUuid(string $uuid, ?array $relations);
  public function approve(string $uuid);
  public function reject(string $uuid);
}