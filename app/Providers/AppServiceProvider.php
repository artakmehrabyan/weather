<?php

namespace App\Providers;

use App\Http\Controllers\WeatherAlertController;
use Illuminate\Support\ServiceProvider;
use App\Contracts\WeatherServiceInterface;
use App\Services\OpenWeatherMapService;
use App\Contracts\NotificationChannelInterface;
use App\Services\EmailNotificationChannel;
use App\Services\SmsNotificationChannel;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherServiceInterface::class, OpenWeatherMapService::class);

        $this->app->when(WeatherAlertController::class)
            ->needs('$notificationChannels')
            ->give(function () {
                return [
                    new EmailNotificationChannel(),
                ];
            });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
