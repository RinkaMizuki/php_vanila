<?php

namespace App\Services;

use App\Database;

abstract class BaseRepository extends Database
{
  public function __construct()
  {
    parent::__construct();
  }
  abstract protected function getById(int $id);
  abstract protected function getAll();
  abstract protected function createEntity($entity);
  abstract protected function updateEntity(int $id);
  abstract protected function deleteById(int $id);
}
