<?php

namespace App\Repositories\Interfaces\Admin;

interface IInventoryRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
}