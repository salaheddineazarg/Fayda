<?php

namespace App\Services\Contracts;

interface OrderItemsServiceInterface
{

    public function all();
    public function createOrderItem(array $data);
    public function updateOrderItem(int $id, array $data);
    public function deleteOrderItem(int $id);
    public function getOrderItem(int $id);
}
