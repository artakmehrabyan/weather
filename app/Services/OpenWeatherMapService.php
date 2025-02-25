<?php
namespace App\Services;

use App\Contracts\WeatherServiceInterface;
use GuzzleHttp\Client;

class OpenWeatherMapService implements WeatherServiceInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getWeatherData(string $city): array
    {
        $apiKey = config('services.weather.api_key');
        $response = $this->client->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}");
        return json_decode($response->getBody(), true);
    }
}
