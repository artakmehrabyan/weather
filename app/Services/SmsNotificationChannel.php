<?php
namespace App\Services;

use App\Contracts\NotificationChannelInterface;
use Twilio\Rest\Client;

class SmsNotificationChannel implements NotificationChannelInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function send(string $message): void
    {
        $this->client->messages->create(
            auth()->user()->phone_number,
            [
                'from' => config('services.twilio.from'),
                'body' => $message,
            ]
        );
    }
}
