<?php
namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function login(array $data);
    public function logout();
    public function register(array $data);

}
