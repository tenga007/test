<?php

namespace app\modules\notifier\models;

class TelegramIntegrator implements IntegratorInterface
{
    public function getTitle(): string
    {
        return 'Telegram';
    }

    public function send(string $message): bool
    {
        return (bool)rand(0, 1);
    }
}