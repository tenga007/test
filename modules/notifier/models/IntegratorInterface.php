<?php

namespace app\modules\notifier\models;

interface IntegratorInterface
{
    public function getTitle(): string;
    public function send(string $message): bool;
}