<?php

use app\modules\notifier\models\db\Notifications;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\notifier\models\db\Notifications $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notifiers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notifier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'sended_at',
        ],
    ]) ?>

</div>
