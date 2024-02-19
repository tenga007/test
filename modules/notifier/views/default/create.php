<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\notifier\models\db\Notifications $model */

$this->title = 'Create Notifier';
$this->params['breadcrumbs'][] = ['label' => 'Notifiers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
