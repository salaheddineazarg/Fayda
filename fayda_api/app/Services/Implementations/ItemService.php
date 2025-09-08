<?php

namespace App\Services\Implementations;


use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Services\Contracts\ItemServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemService implements ItemServiceInterface
{

    private ItemRepositoryInterface $itemRepository;
    private StoreRepositoryInterface $storeRepository;


    public function __construct(ItemRepositoryInterface $itemRepository,
                                StoreRepositoryInterface $storeRepository,

    ){
        $this->itemRepository = $itemRepository;
        $this->storeRepository = $storeRepository;

    }

    public function getById($id)
    {
        try {
          $item= $this->itemRepository->find($id);
            if (isset($item->ratings_avg_rating_value)) {
                $item->average_rating = round($item->ratings_avg_rating_value, 1);
            }

            return $item;
        }catch (ModelNotFoundException $e){
            throw new \Exception("Item not found".$e->getMessage(),404);
        }

    }

    public function all()
    {
        $items= $this->itemRepository->all();

        return $items->map(function ($item) {
            $item->average_rating = $item->ratings_avg_rating_value
                ? round($item->ratings_avg_rating_value, 1)
                : null;
            unset($item->ratings_avg_rating_value);
            return $item;
        });
    }

    public function create(array $data)
    {
        try {
            $this->storeRepository->find($data['store_id']);
            return $this->itemRepository->create($data);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Store not found.', 404);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to create item: ' . $e->getMessage(), 500);
        }
    }



    public function update(array $data,int $id)
    {
        try {
            $this->itemRepository->find($id);
            return $this->itemRepository->update($data, $id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Item not found.', 404);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to update item: ' . $e->getMessage(), 500);
        }
    }

    public function delete(int $id)
    {
        try {
             $this->itemRepository->find($id);
            return $this->itemRepository->delete($id);

        } catch (ModelNotFoundException $e) {
            throw new \Exception('Item not found.', 404);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to delete item: ' . $e->getMessage(), 500);
        }
    }


}
