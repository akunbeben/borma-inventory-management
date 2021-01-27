<?php

namespace App\Repositories\Interfaces\Admin;

interface IUpProductRepository
{
  public function paginated(int $perPage, ?array $relations = null, ?string $searchQuery = null);
}