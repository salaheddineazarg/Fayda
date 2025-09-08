<?php
namespace App\Repositories\Contracts;


interface OrderRepositoryInterface {
    public function find(int $id);
    public function all();
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete($id);
}
