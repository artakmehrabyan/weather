<?php

namespace App\Contracts;

interface NotificationChannelInterface
{
    public function send(string $message): void;
}
