<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\CalendarFilterForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'row'], 'method' => 'get', 'action' => '/calendar']); ?>
    <div class="col-4">
        <?= $form->field($model, 'countryId')->dropDownList(
            $model->getCountries(),
            ['onchange' => 'this.form.submit()', 'prompt' => '--']
        ) ?>
    </div>

    <div class="col-4">
        <?= $form->field($model, 'regionId')->dropDownList(
            $model->getRegions(),
            ['onchange' => 'this.form.submit()', 'prompt' => '--']
        ) ?>

    </div>

    <div class="col-4">
        <?= $form->field($model, 'cityId')->dropDownList(
            $model->getCities(),
            ['onchange' => 'this.form.submit()', 'prompt' => '--']
        ) ?>

    </div>

    <div class="col-6">
        <?= $form->field($model, 'salonId')->dropDownList(
            $model->getSalons(),
            ['onchange' => 'this.form.submit()', 'prompt' => '--']
        ) ?>
    </div>

    <div class="col-6">
        <?= $form->field($model, 'cabinetId')->dropDownList(
            $model->getCabinets(),
            ['onchange' => 'this.form.submit()', 'prompt' => '--']
        ) ?>
    </div>

    <div class="col-3">
        <?= Html::button('Create Event', ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-3">
        <?= Html::button('Create Schedule', ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-6">
        s
    </div>

    <?php ActiveForm::end(); ?>

</div>
