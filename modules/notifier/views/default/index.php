<?php

use app\modules\notifier\models\db\Notifications;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\notifier\models\NotificationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notifiers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notifier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'integrator',
                'value' => fn(Notifications $model) => Notifications::getIntegrators()[$model->integrator],
            ],
            [
                'attribute' => 'status',
                'value' => fn(Notifications $model) => Notifications::getStatuses()[$model->status],
            ],
            'text',
            'created_at',
            //'sended_at',
            [
                'class' => ActionColumn::class,
                'visibleButtons' => [
                    'update' => fn(Notifications $model) => $model->status == Notifications::STATUS_WAIT,
                ],
                'urlCreator' => function ($action, Notifications $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
