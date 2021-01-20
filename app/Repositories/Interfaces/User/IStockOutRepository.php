<?php

namespace App\Repositories\Interfaces\User;

interface IStockOutRepository
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function getStockOutType();
  public function create(array $attributes);
  public function getByUuid(string $uuid, ?array $relations);
  public function appendChild(string $uuid, array $attributes);
  public function removeChild(string $uuid);
  public function submit(string $uuid);
}