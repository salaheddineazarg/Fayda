<?php

namespace App\Http\Controllers;

use App\Services\Contracts\StoreServiceInterface;
use Illuminate\Http\Request;




class StoreController extends Controller
{

     protected StoreServiceInterface $storeService;

     public function __construct(StoreServiceInterface $storeService)
     {
        $this->storeService = $storeService;
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->all();

        return response()->json([
            'success' => true,
            'data' => $stores
        ],200);
    }

    public function show($id){
    $store = $this->storeService->getById($id);
     if($store){
         return response()->json([
             'success' => true,
             'data' => $store
         ],200);
     }
     return response()->json([
         'success' => false,
         'message' => 'Store not found'
     ],404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'type' => 'required|string',
            'address' => 'required|string',
            'vendor_id' => 'required|exists:users,id',
            'status' => 'in:PENDING,ACCEPTED,REJECTED',
        ]);

        $store = $this->storeService->create($validation);
          if ($store){
              return response()->json([
                  'success' => true,
                  'message' => 'Store created successfully.',
                  'data' => $store
              ], 201);
          }
          return response()->json([
              'success' => false,
              'message' => 'Store could not be created.',
          ],400);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,int $id)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'type' => 'required|string',
            'address' => 'required|string',
            'vendor_id' => 'required|exists:users,id',
            'status' => 'in:PENDING,ACCEPTED,REJECTED',
        ]);
        $updateStore = $this->storeService->update($id, $validation);
        if ($updateStore){
            return response()->json([
                'success' => true,
                'message' => 'Store updated successfully.',
                'data'=>$updateStore,
            ],201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Store not found or could not be updated.',
        ],404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
       $deleteStore = $this->storeService->delete($id);
        if ($deleteStore) {
            return response()->json([
                'success' => true,
                'message' => 'Store deleted successfully.'
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Store not found or could not be deleted.'
        ], 404);
    }

    public function changeStatus($id,Request $request)
    {
     $data = $this->storeService->changeStatus($id, $request['status']);

     if ($data){
         return response()->json([
             'success' => true,
             'message' => 'Store status successfully changed.',
             'data' => $data
         ],200);
     }
      return response()->json([
          'success' => false,
          'message' => 'Store not found or status could not be changed.',

      ],404);
    }
}
