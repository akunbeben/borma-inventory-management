<?php

namespace App\Repositories\Interfaces;

interface IBaseRepository
{
  public function getAll();
  public function getById(int $id);
  public function store(array $attributes);
  public function update(int $id, array $attributes);
  public function destroy(int $id);
  public function checkIfExist($data);
}