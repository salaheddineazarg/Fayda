<?php
namespace App\Repositories\Contracts;

interface RatingRepositoryInterface
{
  public function create(array $data);
  public function update(array $data, int $id);
  public function findByUserAndItem(int $idCustomer, int $idItem);

}
