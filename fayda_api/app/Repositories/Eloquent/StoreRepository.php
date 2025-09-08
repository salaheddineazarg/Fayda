<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface{

    public function all()
    {
       return Store::all();
    }

    public function find($id)
    {
        return Store::with('items')->findOrFail($id);
    }


    public function create(array $data)
    {
        return Store::create($data);
    }


    public function update($id, array $data)
    {
            $store = Store::findOrFail($id);
            $store->update($data);
            return $store;
    }

    public function delete($id)
    {
        $store = Store::findOrFail($id);
        return $store->delete();
    }


    public function changeStatus($id, string $status)
    {

        $store = Store::findOrFail($id);
        $store->status = $status;
        $store->save();

        return $store;
    }
}
