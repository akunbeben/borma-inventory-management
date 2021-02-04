<?php

namespace App\Repositories\Interfaces\Admin;

interface IReportRepository 
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery, int $documentType);
  public function create(array $attributes, string $createdBy, int $documentType);
}