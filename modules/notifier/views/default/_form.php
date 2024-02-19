<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\notifier\models\db\Notifications $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notifier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'integrator')->dropDownList(\app\modules\notifier\models\db\Notifications::getIntegrators()) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
