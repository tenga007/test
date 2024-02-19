<?php

namespace app\modules\notifier;

/**
 * php yii migrate --migrationPath=@app/modules/notifier/migrations
 * php yii notifier/cmd/run
 */

/**
 * notifier module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\notifier\controllers';

    public $controllerMap = [
        'cmd' => 'app\modules\notifier\commands\NotificationsController',
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
