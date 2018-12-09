<?php

namespace ARJUN\JWT;

use Illuminate\Support\ServiceProvider;

class JWTSERVICEPROVIDER extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/ROUTES/web.php');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register() {
        
    }

}

?>