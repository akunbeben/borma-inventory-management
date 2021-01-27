<?php

namespace App\Repositories\Interfaces\Admin;

interface INewProductRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
}