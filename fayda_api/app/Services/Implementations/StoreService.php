<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\StoreServiceInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class StoreService implements StoreServiceInterface {

    private StoreRepositoryInterface $storeRepository;
    private UserRepositoryInterface$userRepository;

    public function __construct(StoreRepositoryInterface $storeRepository,
                               UserRepositoryInterface $userRepository) {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }

    public function getById(int $id)
    {
        try {
           return $this->storeRepository->find($id);
        }catch (ModelNotFoundException $e){
            throw new \Exception("Store not found".$e->getMessage(),404);
        }

    }

    public function all()
    {
        return $this->storeRepository->all();
    }

    public function create(array $data) {

        $vendor =$this->userRepository->find($data['vendor_id']);
        if (!$vendor->isVendor()) {
            throw new \Exception('Only vendors can create stores.');
        }
        return $this->storeRepository->create($data);
    }


    public function update(int $id, array $data)
    {
        try {
            return $this->storeRepository->update($id, $data);
        }catch (ModelNotFoundException $e){
            throw new \Exception('Store not found.'. $e->getMessage(),404);
        }
    }

    public function delete(int $id)
    {
        try {
            $store = $this->storeRepository->findOrFail($id);

            $vendor = User::find($store->vendor_id);

            if (!$vendor || !$vendor->isVendor()) {
                throw new \Exception('Only vendors can delete store.', 403);
            }
            return $this->storeRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Store not found.', 404);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to delete store: ' . $e->getMessage(), 500);
        }
    }

    public function changeStatus(int $id, string $status)
    {
        $validStatuses = ['PENDING', 'ACCEPTED', 'REJECTED'];

        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status provided.');
        }
        return $this->storeRepository->changeStatus($id, $status);
    }
}

