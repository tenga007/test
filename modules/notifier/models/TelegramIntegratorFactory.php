<?php

namespace app\modules\notifier\models;

class TelegramIntegratorFactory implements IntegratorFactoryInterface
{

    public function createIntegrator(): IntegratorInterface
    {
        return new TelegramIntegrator();
    }
}