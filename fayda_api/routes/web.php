<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-binding', function() {
    try {
        $service = app(App\Services\Contracts\StoreServiceInterface::class);
        return get_class($service); // Should return App\Services\StoreService
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'bindings' => app()->getBindings()
        ];
    }
});
