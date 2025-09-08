<?php

namespace App\Repositories\Eloquent;

use App\Models\Rating;
use App\Repositories\Contracts\RatingRepositoryInterface;

class RatingRepository implements RatingRepositoryInterface
{

    public function create(array $data)
    {
       return Rating::create($data);
    }

    public function update(array $data, int $id)
    {
      $rating = Rating::findOrFail($id);
     return $rating->update($data);
    }


    public function findByUserAndItem(int $idCustomer, int $idItem)
    {
       return Rating::where('customer_id', $idCustomer)
                    ->where('item_id', $idItem)
                    ->first();
    }
}
