<?php

namespace Shuaau\OpenWeather\Facades;

use Illuminate\Support\Facades\Facade;

class Weather extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Weather';
    }

}
