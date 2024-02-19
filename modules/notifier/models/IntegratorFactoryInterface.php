<?php

namespace app\modules\notifier\models;

interface IntegratorFactoryInterface
{
    public function createIntegrator(): IntegratorInterface;
}