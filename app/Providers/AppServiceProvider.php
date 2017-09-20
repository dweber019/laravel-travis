<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

use Auth0\Login\Contract\Auth0UserRepository as Auth0UserRepositoryContract;
use Auth0\SDK\Helpers\Cache\CacheHandler as CacheHandler;

use App\AuthUserRepository as AuthUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
          CacheHandler::class,
          function () {
              static $cacheWrapper = null;
              if ($cacheWrapper === null) {
                  $cache = Cache::store();
                  $cacheWrapper = new LaravelCacheWrapper($cache);
              }

              return $cacheWrapper;
          }
        );

        $this->app->bind(
          Auth0UserRepositoryContract::class,
          AuthUserRepository::class
        );
    }
}
