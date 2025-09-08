<?php

namespace App\Services\Implementations;

use App\Repositories\Contracts\RatingRepositoryInterface;
use App\Services\Contracts\RatingServiceInterface;

class RatingService implements RatingServiceInterface
{
    public function __construct(private RatingRepositoryInterface $ratingRepository){

    }


    public function create($data)
    {
      $existingRating = $this->ratingRepository->findByUserAndItem($data['customer_id'], $data['item_id']);

      if($existingRating){
          $this->ratingRepository->update(['rating_value' => $data['rating_value']],($existingRating->id));
          return $existingRating->fresh();
      }
      return $this->ratingRepository->create($data);
    }
}
