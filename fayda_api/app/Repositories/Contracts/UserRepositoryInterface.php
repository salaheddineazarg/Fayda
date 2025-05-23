<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface{
    public function find(int $id);
}
