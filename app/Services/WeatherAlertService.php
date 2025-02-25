<?php
namespace App\Services;

use App\Contracts\WeatherServiceInterface;
use App\Contracts\NotificationChannelInterface;

class WeatherAlertService
{
    protected $weatherService;
    protected $notificationChannels;

    public function __construct(WeatherServiceInterface $weatherService, array $notificationChannels)
    {
        $this->weatherService = $weatherService;
        $this->notificationChannels = $notificationChannels;
    }

    public function checkAndNotify(string $city, float $precipitationThreshold, int $uvIndexThreshold): void
    {
        $weatherData = $this->weatherService->getWeatherData($city);

        $precipitation = $weatherData['rain']['1h'] ?? 0;
        $uvIndex = $weatherData['current']['uvi'] ?? 0;

        if ($precipitation > $precipitationThreshold) {
            $this->sendNotification("High precipitation alert in {$city}: {$precipitation}mm");
        }

        if ($uvIndex > $uvIndexThreshold) {
            $this->sendNotification("High UV index alert in {$city}: {$uvIndex}");
        }
    }

    protected function sendNotification(string $message): void
    {
        foreach ($this->notificationChannels as $channel) {
            $channel->send($message);
        }
    }
}
