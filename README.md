## Laravel Open Weather

This package manages Open Weather API.

##
#### Requirements:

This package requires Laravel version >= 6.0 and php version >=7.2.

| Version      | Laravel Version |
| ----------- | ----------- |
| ^1.0      | ^6.0       |

##
#### Installation:
Use composer to download the package
```
composer require mohamedshuaau/open-weather
```

Laravel's auto discovery should register the package service provider.

After the installation, you can publish the package content with:
```
php artisan vendor:publish
```

The publish command will publish the configuration file to config folder.

Change the default values of the configuration file (API Key etc).

##
#### Basic Usage:

```php

$weather = Weather::getByGeoCoordinates('39.157711', '21.249649')
                    ->getFiveDayWeatherForecast();

return $weather;

```

There are different methods available for different types of data:
```php
//In this example, we will get the current weather
Weather::getByGeoCoordinates('39.157711', '21.249649')
         ->getCurrentWeather();

//You can chain different methods of getting the city/state/country information
//in the above example, the geo location is used which accepts lat and long value
```

Available methods to get the city/state/country:

```php
//Gets the city by name/state code/country code
//params: city name (required), state code (optional), country code (optional)
Weather::getByCityName('New York', '467', 'US');

//Gets the city information by city id
//params: city id (required)
Weather::getByCityId('2377474');

//Gets the city information by geo location coordinates
//params: latitude (required), longitude (required)
Weather::getByGeoCoordinates('12.434333', '34.434555');

//Gets the city information by zip code
//params: zip code (required), country code (optional)
Weather::getByZipCode('34433', '23434444');
```

Available methods for types of weather:

```php
//with each of these methods, it is mandatory to chain a location method. Eg:
//Weather::getByCityId('2377474')->getCurrentWeather();

//Gets the current weather information
Weather::getCurrentWeather();

//Gets the weather information for the last five days with 3 hours difference in between
//params: limit amount (optional)
Weather::getFiveDayWeatherForecast(3);

//Gets sixteen days weather information with per day information
//params: limit amount (optional)
Weather::getSixteenDayWeatherForecast(3);

//Gets the hourly weather forecast data (requires paid account)
//params: limit amount (optional)
Weather::getHourlyWeatherForecast(3);

//Gets thirty day climate forecast data (requires paid account)
//params: limit amount (optional)
Weather::getThirtyDayClimateForecast(3);

//On Call API
Weather::oneCall();

//Returns historical weather data
//params: type (optional)
Weather::historicalWeather();

//Returns current UV
Weather::CurrentUV();

//Returns Forecast UV
//params: limit amount (optional)
Weather::ForecastUV();

//Returns Historical UV
//params: limit amount (optional), start date (optional|unix date), end date (optional|unix date)
Weather::HistoricalUV();
```

Aside from the default configurations available in the published config file,
you may override the values with method chaining:

```php
//lets change the language, units and mode
Weather::language('ja')
         ->units('metric')
         ->mode('html')
         ->getByCityId('2377474')
         ->getCurrentWeather();
```

The unit determines the units in measure and the mode is the return data type.

The available units are:
<br>
- metric
- imperial
- standard
<br>
By default, the unit is set to standard.

The available modes are:
<br>
- html
- xml
- json
<br>
By default, the mode is set to json.

For more information in detail, you may visit [Open Weather API Docs](https://openweathermap.org/api)

More features are to come in the future. This package is open for suggestions
and improvements.
<br>
You are free to use this package and modify it to your needs.
