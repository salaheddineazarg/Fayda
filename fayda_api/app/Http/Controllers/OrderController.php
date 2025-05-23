<?php

namespace App\Http\Controllers;

use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(private readonly OrderServiceInterface $orderService ){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

        public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $order = $this->orderService->create($validated);

        return response()->json([
            'success' => (bool)$order,
            'data' => $order ?? null,
             'message'=> $order ? 'Order created!' : 'Error creating order!'
        ], $order ? 201 : 400);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
