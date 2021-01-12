<?php

namespace App\Repositories\Interfaces\Admin;

interface ISupplierRepository 
{
  public function paginated(int $perPage, ?array $relations, ?string $searchQuery);
  public function getByUuid(string $uuid, ?array $relations);
  public function save(array $attributes, string $createBy);
  public function updates(string $uuid, array $attributes);
  public function delete(string $uuid);
}