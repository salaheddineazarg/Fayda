<?php

namespace App\Services\Implementations;

use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function __construct(private  OrderRepositoryInterface $orderRepository,
    private OrderItemsRepositoryInterface $orderItemsRepository){}


    public function all()
    {
       return $this->orderRepository->all();
    }

    public function find(int $id)
    {
        return $this->orderRepository->find($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $order = $this->orderRepository->create($data);
            $finalTotal = 0;
            foreach ($data['items'] as $item) {
                $item['order_id'] = $order->id;
                $item['total'] = $item['quantity'] * $item['price'];
                $this->orderItemsRepository->create($item);
                $finalTotal += $item['total'];
            }
            $this->orderRepository->update([
                'total_price' => $finalTotal
            ], $order->id);

            return $order->fresh();
        });
    }

    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $order = $this->orderRepository->update($data, $id);

            if (isset($data['items'])) {
                // Optional: Delete old items if needed
                $this->orderItemsRepository->deleteByOrderId($id);

                // Insert updated items
                foreach ($data['items'] as $itemData) {
                    $itemData['order_id'] = $id;
                    $this->orderItemsRepository->create($itemData);
                }
            }

            return $order;
        });
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            // First delete related order items
            $this->orderItemsRepository->deleteByOrderId($id);

            // Then delete the order
            return $this->orderRepository->delete($id);
        });
    }
    public function CalculateOrderItems(float $price,int $quantity)
    {

    }
}
