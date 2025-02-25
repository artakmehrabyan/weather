<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherAlertService;
use App\Contracts\WeatherServiceInterface;
use App\Contracts\NotificationChannelInterface;

class WeatherAlertController extends Controller
{
    protected $weatherAlertService;

    public function __construct(
        WeatherServiceInterface $weatherService,
        array $notificationChannels
    ) {
        $this->weatherAlertService = new WeatherAlertService($weatherService, $notificationChannels);
    }

    public function checkWeather(Request $request)
    {

        $cities = $request->input('cities', []);

        $user = auth()->user();
        $preferences = $user->preferences;

        if (!$preferences) {
            return redirect()->back()->with('error', 'Please set your preferences first.');
        }


        foreach ($cities as $city) {
            $this->weatherAlertService->checkAndNotify(
                $city,
                $preferences->precipitation_threshold,
                $preferences->uv_index_threshold
            );
        }

        return redirect()->back()->with('success', 'Weather checked and notifications sent for selected cities!');
    }
}
