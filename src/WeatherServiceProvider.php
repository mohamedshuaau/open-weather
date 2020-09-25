<?php

namespace Shuaau\OpenWeather;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider {

    public function boot() {

        $this->publishes([
            __DIR__.'/../config/weather.php' => config_path('./weather.php')
        ]);

    }

    public function register()
    {
        $this->app->bind('Weather', function () {
            return new Weather();
        });
    }

}
