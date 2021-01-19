<?php

namespace App\Repositories\Interfaces\User;

interface IStockInRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function createOrderStockIn(array $attributes);
  public function getStockInType();
  public function getStockInDetail(string $uuid, ?array $relations);
  public function storeOrder(string $uuid, array $attributes);
  public function deleteBody(string $uuid);
  public function submitBody(array $attributes);
  public function submitOrder(string $uuid);
}