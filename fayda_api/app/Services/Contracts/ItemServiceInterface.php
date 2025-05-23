<?php
namespace App\Services\Contracts;

interface ItemServiceInterface {

    public function all();
    public function create(array $data);
    public function update(array $data,int $id);
    public function delete(int $id);
    public function getById(int $id);
}
