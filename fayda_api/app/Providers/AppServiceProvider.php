<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\RatingRepositoryInterface;
use App\Repositories\Contracts\StoreRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\ItemRepository;
use App\Repositories\Eloquent\OrderItemsRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\RatingRepository;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\ItemServiceInterface;
use App\Services\Contracts\OrderItemsServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\RatingServiceInterface;
use App\Services\Contracts\StoreServiceInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\ItemService;
use App\Services\Implementations\OrderItemsService;
use App\Services\Implementations\OrderService;
use App\Services\Implementations\RatingService;
use App\Services\Implementations\StoreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->singleton(StoreServiceInterface::class,StoreService::class);
        $this->app->singleton(StoreRepositoryInterface::class, StoreRepository::class);

        $this->app->singleton(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->singleton(ItemServiceInterface::class, ItemService::class);

        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        $this->app->singleton(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);

        $this->app->singleton(OrderItemsRepositoryInterface::class, OrderItemsRepository::class);
        $this->app->singleton(OrderItemsServiceInterface::class, OrderItemsService::class);

        $this->app->singleton(RatingRepositoryInterface::class, RatingRepository::class);
        $this->app->singleton(RatingServiceInterface::class, RatingService::class);

        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
        $this->app->singleton(AuthRepositoryInterface::class, AuthRepository::class);

    }


    public function boot(): void
    {
        //
    }
}
