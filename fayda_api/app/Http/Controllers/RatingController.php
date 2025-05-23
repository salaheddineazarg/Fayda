<?php

namespace App\Http\Controllers;

use App\Services\Contracts\RatingServiceInterface;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function __construct(private RatingServiceInterface $ratingService){}

    public function store(Request $request){
        $validated = $request->validate([
            'rating_value' => 'required|integer|between:1,5',
            'customer_id' => 'required|integer|exists:users,id',
            'item_id' => 'required|integer|exists:items,id'
        ]);
        $rating =$this->ratingService->create($validated);
        return response()->json([
            'success' => (bool)$rating,
            'rating' => $rating ? $rating : null,
            'message'=> $rating ? 'rating created' : 'rating not created',
        ],$rating ? 200 : 400);
    }
}
