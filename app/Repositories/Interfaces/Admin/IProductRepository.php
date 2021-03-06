<?php

namespace App\Repositories\Interfaces\Admin;

interface IProductRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery, int $productType);
  public function save(array $attributes, int $productType, string $userId);
  public function updates(array $attributes, string $uuid, int $productType);
  public function getByUuid(string $uuid, ?array $relations, ?int $productType);
  public function delete(string $uuid, int $productType);
  public function getAvailableProducts(?array $data, string $type);
  public function getUnselectedProduct(string $table, string $column, ?array $clause = null);
}