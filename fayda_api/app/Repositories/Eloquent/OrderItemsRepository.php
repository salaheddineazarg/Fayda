<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\Order_items;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;

class OrderItemsRepository implements OrderItemsRepositoryInterface
{


    public function all()
    {
       Order_items::with(['order','item'])->get();
    }

    public function create(array $data)
    {
       return Order_items::create($data);
    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {

    }

    public function deleteByOrderId(int $orderId)
    {
        return OrderItem::where('order_id', $orderId)->delete();
    }
}
