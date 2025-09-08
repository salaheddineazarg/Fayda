<?php

namespace App\Services\Implementations;

use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Services\Contracts\OrderItemsServiceInterface;

class OrderItemsService implements OrderItemsServiceInterface
{

    public function __construct(private  OrderItemsRepositoryInterface $orderItemRepository){

    }

    public function all()
    {

        return $this->orderItemRepository->all();
    }

    public function createOrderItem(array $data)
    {
      return $this->orderItemRepository->create($data);
    }

    public function updateOrderItem(int $id, array $data)
    {
        // TODO: Implement updateOrderItem() method.
    }

    public function deleteOrderItem(int $id)
    {
        // TODO: Implement deleteOrderItem() method.
    }

    public function getOrderItem(int $id)
    {
        // TODO: Implement getOrderItem() method.
    }
}
