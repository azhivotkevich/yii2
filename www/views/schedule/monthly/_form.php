<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DailySchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daily-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cabinet_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'time_from')->textInput() ?>

    <?= $form->field($model, 'time_to')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'active' => 'Active', 'disabled' => 'Disabled', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
