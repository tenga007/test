<?php

namespace app\modules\notifier\models;

class SmsIntegrator implements IntegratorInterface
{
    public function getTitle(): string
    {
        return 'Sms';
    }

    public function send(string $message): bool
    {
        return (bool)rand(0, 1);
    }
}