<?php

namespace app\modules\notifier\commands;

use app\modules\notifier\models\db\Notifications;
use yii\console\Controller;
use yii\console\ExitCode;

class NotificationsController extends Controller
{
    public function actionRun()
    {
        $notifications = Notifications::find()
            ->where(['status' => Notifications::STATUS_WAIT])
            ->all();

        foreach ($notifications as $notification) {
            $status = $notification->sendNotification() ? 'sended' : 'not sended';
            echo 'Notification ' . $notification->id. ' integrator ' . $notification->getIntegrator()->getTitle(). ' status:' . $status . PHP_EOL;
        }
        return ExitCode::OK;
    }
}