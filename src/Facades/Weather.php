<?php

namespace Shuaau\OpenWeather\Facades;

use Illuminate\Support\Facades\Facade;

class Weather extends Facade {

    /**
     * @method \Shuaau\OpenWeather\Weather getCurrentWeather()
     * @method \Shuaau\OpenWeather\Weather getFiveDayWeatherForecast(int $cnt = null)
     * @method \Shuaau\OpenWeather\Weather getSixteenDayWeatherForecast(int $cnt = null)
     * @method \Shuaau\OpenWeather\Weather getHourlyWeatherForecast(int $cnt = null)
     * @method \Shuaau\OpenWeather\Weather getThirtyDayClimateForecast(int $cnt = null)
     * @method \Shuaau\OpenWeather\Weather oneCall(array $exclude = [])
     * @method \Shuaau\OpenWeather\Weather historicalWeather(string $cnt = null, string $type = null, string $start = null, string $end = null)
     * @method \Shuaau\OpenWeather\Weather CurrentUV()
     * @method \Shuaau\OpenWeather\Weather ForecastUV(int $cnt = null)
     * @method \Shuaau\OpenWeather\Weather HistoricalUV(int $cnt = null, string $start = null, string $end = null)
     * @method \Shuaau\OpenWeather\Weather getByCityName(string $cityName, string $stateCode = null, string $countyCode = null)
     * @method \Shuaau\OpenWeather\Weather getByCityId(string $id)
     * @method \Shuaau\OpenWeather\Weather getByGeoCoordinates(string $latitude, string $longitude)
     * @method \Shuaau\OpenWeather\Weather getByZipCode(string $zip, string $countryCode = null)
     * @method \Shuaau\OpenWeather\Weather language(string $lang)
     * @method \Shuaau\OpenWeather\Weather units(string $unit)
     * @method \Shuaau\OpenWeather\Weather mode(string $mode)
     * @method \Shuaau\OpenWeather\Weather mode(string $mode)
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Weather';
    }

}
