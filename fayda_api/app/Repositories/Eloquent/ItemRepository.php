<?php

namespace App\Repositories\Eloquent;

use App\Models\Item;
use App\Repositories\Contracts\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface {

    public function all()
    {
       return Item::with('store')
           ->withAvg('ratings', 'rating_value')
           ->get();
    }

    public function create(array $data){

        return Item::create($data);
    }


    public function update(array $data, $id)
    {
       $item = Item::findOrFail($id);
       $item->update($data);
       return $item;
    }

    public function delete($id)
    {
       $item = Item::findOrFail($id);
       return $item->delete();
    }

    public function find($id)
    {
        return Item::with('store')->withAvg('ratings', 'rating_value')->get()
            ->findOrFail($id)
            ->makeHidden('ratings_avg_rating_value');
    }
}

