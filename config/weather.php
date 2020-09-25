<?php

return [

    'base_url' => env('WEATHER_API_BASE_URL', 'http://api.openweathermap.org/data/2.5/'),
    'api_key' => env('WEATHER_API_KEY', '2c45e8649388c571196bfcab69db107f'),

    'lang' => env('WEATHER_API_LANG', 'en'),

    'units' => env('WEATHER_API_UNITS', 'standard'),

    'mode' => env('WEATHER_API_MODE', 'JSON'),

];
