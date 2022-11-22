<?php

namespace Apersestudio\Digitalocean {

    Illuminate\Support\ServiceProvider as LaravelServiceProvider;

    class ServiceProvider extends LaravelServiceProvider {

        /**
         * Bootstrap any package services.
         *
         * @return void
         */
        public function boot() {
            $this->publishes([
                __DIR__.'/../config/digitalocean.php' => \config_path('digitalocean.php'),
            ]);
        }

    }

}

?>