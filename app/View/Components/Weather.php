<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Weather extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(protected $latitude = 26.1, protected $longitude = 91.7)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $apiKey = config('freshman.openweather_api_key');

        // $urlWeather = "https://api.openweathermap.org/data/2.5/weather?lat=".$this->latitude."&lon=".$this->longitude."&units=metric&appid=".$apiKey;
        // $urlForecast = "https://api.openweathermap.org/data/2.5/forecast/daily?lat=".$this->latitude."&lon=".$this->longitude."&units=metric&appid=".$apiKey;

        if (Cache::has('current_weather')) {
            $currentData = Cache::get('current_weather');
        } else {
            $responses = Http::get('http://api.openweathermap.org/data/2.5/weather', [
                'lat' => $this->latitude,
                'lon' => $this->longitude,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);
            $currentData = json_decode($responses->body(), true);
            Cache::put('current_weather', $currentData, 2); // cache the response for 24 hours
        }

        if (Cache::has('7day_forecast')) {
            $forecast = Cache::get('7day_forecast');
        } else {
            $responses = Http::get('http://api.openweathermap.org/data/2.5/forecast/daily', [
                'lat' => $this->latitude,
                'lon' => $this->longitude,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);
            $forecast = json_decode($responses->body(), true);
            Cache::put('7day_forecast', $forecast, 2); // cache the response for 24 hours
        }
 
        return view('components.app.weather', [
            'currentData' => $currentData,
            'forecast' => $forecast['list']
        ]);
    }
}
