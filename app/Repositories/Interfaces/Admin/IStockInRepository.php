<?php

namespace App\Repositories\Interfaces\Admin;

interface IStockInRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function createOrderStockIn(array $attributes);
  public function getStockInType();
  public function getStockInDetail(string $uuid, ?array $relations);
  public function approve(string $uuid);
  public function reject(string $uuid);
}