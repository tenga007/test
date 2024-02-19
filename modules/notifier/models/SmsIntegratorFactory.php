<?php

namespace app\modules\notifier\models;

class SmsIntegratorFactory implements IntegratorFactoryInterface
{

    public function createIntegrator(): IntegratorInterface
    {
        return new SmsIntegrator();
    }
}