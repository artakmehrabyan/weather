<?php
namespace App\Services;

use App\Contracts\NotificationChannelInterface;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class EmailNotificationChannel implements NotificationChannelInterface
{
    public function send(string $message): void
    {
        Mail::to(auth()->user()->email)->send(new MailMessage([
            'subject' => 'Weather Alert',
            'line' => $message,
        ]));
    }
}
