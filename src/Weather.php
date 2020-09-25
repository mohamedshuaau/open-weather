<?php

namespace Shuaau\OpenWeather;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class Weather {

    /**
     * Language
     * @var $lang
     */
    public $lang;

    /**
     * Unit of measure
     * @var $units
     */
    public $units;

    /**
     * Response type/mode
     * @var $mode
     */
    public $mode;

    /**
     * Limit data
     * @var $cnt
     */
    public $cnt;

    /**
     * Call type
     * @var $type
     */
    public $type;

    /**
     * Start time in unix format
     * @var $start_time
     */
    public $start_time;

    /**
     * End time in unix format
     * @var $end_time
     */
    public $end_time;

    /**
     * Id of the city
     * @var $cityId
     */
    public $cityId;

    /**
     * Name of the city
     * @var $cityName
     */
    public $cityName;

    /**
     * State code
     * @var $stateCode
     */
    public $stateCode;

    /**
     * Country code
     * @var $countyCode
     */
    public $countyCode;

    /**
     * Location latitude
     * @var $latitude
     */
    public $latitude;

    /**
     * Location longitude
     * @var $longitude
     */
    public $longitude;

    /**
     * Zip code
     * @var $zip
     */
    public $zip;

    /**
     * Country code
     * @var $zipCountyCode
     */
    public $zipCountyCode;

    /**
     * What data to exclude
     * @var $exclude
     */
    public $exclude;

    /**
     * Gets the current weather
     * @return \Illuminate\Http\Client\Response
     */
    public function getCurrentWeather() {
        return $this->callAPI('weather');
    }

    /**
     * Get the forecast for five days
     * @param int|null $cnt
     * @return \Illuminate\Http\Client\Response
     */
    public function getFiveDayWeatherForecast(int $cnt = null) {
        $this->cnt = $cnt;
        return $this->callAPI('forecast');
    }

    /**
     * Gets the forecast for for sixteen days
     * @param int|null $cnt
     * @return \Illuminate\Http\Client\Response
     */
    public function getSixteenDayWeatherForecast(int $cnt = null) {
        $this->cnt = $cnt;
        return $this->callAPI('forecast/daily');
    }

    /**
     * Gets the hourly forecast for 4 days
     * @param int|null $cnt
     * @return \Illuminate\Http\Client\Response
     */
    public function getHourlyWeatherForecast(int $cnt = null) {
        $this->cnt = $cnt;
        return $this->callAPI('forecast/hourly');
    }

    /**
     * Get climate forecast for 30 days
     * @param int|null $cnt
     * @return \Illuminate\Http\Client\Response
     */
    public function getThirtyDayClimateForecast(int $cnt = null) {
        $this->cnt = $cnt;
        return $this->callAPI('forecast/climate');
    }

    /**
     * One call API
     * @param array $exclude
     * @return \Illuminate\Http\Client\Response
     */
    public function oneCall(array $exclude = []) {
        return $this->serializeOneCall($exclude);
    }

    /**
     * Historical Weather
     * @param string|null $type
     * @return \Illuminate\Http\Client\Response
     */
    public function historicalWeather(string $type = null) {
        $this->type = $type;
        return $this->callAPI('history/city');
    }

    /**
     * Current UV
     * @return \Illuminate\Http\Client\Response
     */
    public function CurrentUV() {
        return $this->callAPI('uvi');
    }

    /**
     * Forecast UV
     * @param int|null $cnt
     * @return \Illuminate\Http\Client\Response
     */
    public function ForecastUV(int $cnt = null) {
        $this->cnt = $cnt;
        return $this->callAPI('uvi/forecast');
    }

    /**
     * Historical UV
     * @param int|null $cnt
     * @param string|null $start
     * @param string|null $end
     * @return \Illuminate\Http\Client\Response
     */
    public function HistoricalUV(int $cnt = null, string $start = null, string $end = null) {
        $unix_current_date_time = Carbon::now()->timestamp;
        $this->cnt = $cnt;
        $this->start_time = !$start ? $unix_current_date_time : $start;
        $this->end_time = !$end ? $unix_current_date_time : $end;
        return $this->callAPI('uvi/history');
    }

    /**
     * Get by City name
     * @param string $cityName
     * @param string|null $stateCode
     * @param string|null $countyCode
     * @return $this
     */
    public function getByCityName(string $cityName, string $stateCode = null, string $countyCode = null) {
        $this->cityName = $cityName;
        $this->stateCode = $stateCode;
        $this->countyCode = $countyCode;
        return $this;
    }

    /**
     * Get by city id
     * @param string $id
     * @return $this
     */
    public function getByCityId(string $id) {
        $this->cityId = $id;
        return $this;
    }

    /**
     * Get by city geo location (lat, long)
     * @param string $latitude
     * @param string $longitude
     * @return $this
     */
    public function getByGeoCoordinates(string $latitude, string $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get by zip code
     * @param string $zip
     * @param string|null $countryCode
     * @return $this
     */
    public function getByZipCode(string $zip, string $countryCode = null) {
        $this->zip = $zip;
        $this->zipCountyCode = $countryCode;
        return $this;
    }

    /**
     * Set language
     * @param string $lang
     * @return $this
     */
    public function language(string $lang) {
        $this->lang = $lang;
        return $this;
    }

    /**
     * Set unit
     * @param string $unit
     * @return $this
     */
    public function units(string $unit) {
        $this->checkUnits($unit);
        return $this;
    }

    /**
     * Set mode
     * @param string $mode
     * @return $this
     */
    public function mode(string $mode) {
        $this->checkMode($mode);
        return $this;
    }

    /**
     * Get units either from config or prop
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getUnits() {
        return !$this->units ? config('weather.units') : $this->units;
    }

    /**
     * Gets the mode either from config or prop
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getMode() {
        return !$this->mode ? config('weather.mode') : $this->mode;
    }

    /**
     * Gets the language either from config or prop
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getLang() {
        return !$this->lang ? config('weather.lang') : $this->lang;
    }

    /**
     * Check if mode exist
     * @param $mode
     */
    public function checkMode($mode) {
        switch ($mode){
            case 'xml':
                $this->mode = 'xml';
                break;
            case 'html':
                $this->mode = 'html';
                break;
            default:
                $this->units = 'JSON';
                break;
        }
    }

    /**
     * Checks if the entered units exists
     * @param $unit
     */
    public function checkUnits($unit) {
        switch ($unit){
            case 'metric':
                $this->units = 'metric';
                break;
            case 'imperial':
                $this->units = 'imperial';
                break;
            default:
                $this->units = 'standard';
                break;
        }
    }

    /**
     * Serializes the one call/appends excludes
     * @param array $exclude
     * @return \Illuminate\Http\Client\Response
     */
    public function serializeOneCall(array $exclude = []) {
        foreach($exclude as $excludes) {
            $this->exclude .= $excludes.',';
        }
        $str = rtrim($this->exclude, ',');
        $this->exclude = $str;
        return $this->callAPI('onecall');
    }

    /**
     * Gets API Key from config
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getAPIKey() {
        return config('weather.api_key');
    }

    /**
     * Gets API base URL from config
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getBaseUrl() {
        return config('weather.base_url');
    }

    /**
     * Makes API Call
     * @param $type
     * @return \Illuminate\Http\Client\Response
     */
    public function callAPI($type) {

        $base_url = $this->getBaseUrl();
        $key = $this->getAPIKey();

        return Http::get($base_url.$type, [

            'q' => $this->cityName, $this->stateCode, $this->countyCode,
            'zip' => $this->zip, $this->zipCountyCode,
            'lat' => $this->latitude,
            'lon' => $this->longitude,
            'id' => $this->cityId,
            'mode' => $this->getMode(),
            'units' => $this->getUnits(),
            'cnt' => $this->cnt,
            'type' => $this->type,
            'lang' => $this->getLang(),
            'exclude' => $this->exclude,
            'start' => $this->start_time,
            'end' => $this->end_time,
            'appid' => $key

        ]);

    }

}
