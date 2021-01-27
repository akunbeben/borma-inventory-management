<?php

namespace App\Repositories\Interfaces\Admin;

interface IPrepareProductRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
}