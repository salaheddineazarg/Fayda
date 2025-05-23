<?php

namespace App\Services\Contracts;

interface StoreServiceInterface {
      public function getById(int $id);
      public function all();
      public function create(array $data);
      public function update(int $id, array $data);
      public function delete(int $id);
      public function changeStatus(int $id,string $status);
}
