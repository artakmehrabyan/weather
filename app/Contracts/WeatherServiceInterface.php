<?php
namespace App\Contracts;

interface WeatherServiceInterface
{
    public function getWeatherData(string $city): array;
}
