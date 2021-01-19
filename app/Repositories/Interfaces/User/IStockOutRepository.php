<?php

namespace App\Repositories\Interfaces\User;

interface IStockOutRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function getStockOutType();
}