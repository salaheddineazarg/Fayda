<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ItemServiceInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{



    public function __construct(private readonly ItemServiceInterface $itemService){

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemService->all();
        if ($items){
            return response()->json([
                'success' => true,
                'data' => $items
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve items'
        ],404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = now()->format('Y-m-d H:i:s');
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'between:0,999999.99', 'decimal:2'],
            'from_date' => ['nullable', 'date', 'after_or_equal:now'],
            'to_date' => ['nullable', 'date', 'after:from_date'],
            'status' => ['sometimes', 'in:AVAILABLE,UNAVAILABLE'],
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:10000'],
            'category' => ['sometimes', 'in:SECRET_BAG,NORMAL'],
            'store_id' => ['required', 'exists:stores,id'],
        ]);

        $item = $this->itemService->create($validated);

        return response()->json([
            'success' => (bool) $item,
            'data'    => $item ?? null,
            'message' => $item ? 'Item created successfully.' : 'Failed to create item.',
        ], $item ? 201 : 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $item= $this->itemService->getById($id);
       return response()->json([
           'success' => (bool) $item,
           'data'    => $item ?? null,
           'message' => $item ? 'Item retrieved successfully.' : 'Failed to retrieve item.',
       ], $item ? 200 : 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedItem = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'between:0,999999.99', 'decimal:2'],
            'from_date' => ['nullable', 'date', 'after_or_equal:now'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
            'status' => ['sometimes', 'in:AVAILABLE,UNAVAILABLE'],
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:10000'],
            'category' => ['sometimes', 'in:SECRET_BAG,NORMAL'],
            'store_id' => ['required', 'exists:stores,id'],
        ]);
       $updateItem= $this->itemService->update($validatedItem, $id);
        return response()->json([
            'success' => (bool) $updateItem,
            'data'    => $updateItem ?? null,
            'message' => $updateItem ? 'Item updated successfully.' : 'Failed to update item.',
        ], $updateItem ? 201 : 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $deletedItem = $this->itemService->delete($id);
        return response()->json([
            'success' => (bool) $deletedItem,
            'message' => $deletedItem ? 'Item deleted successfully.' : 'Failed to delete item.',
        ], $deletedItem ? 201 : 404);
    }
}
