<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    public function find(int $id)
    {
        return Order::findOrFail($id);
    }

    public function all()
    {
        return Order::all();
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update(array $data, int $id)
    {
      $order = Order::findOrFail($id);
      $order->update($data);
      return $order;
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        return $order->delete();
    }
}
