<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\notifier\models\db\Notifications $model */

$this->title = 'Update Notifier: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notifiers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notifier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
