<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salon-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($countryModel, 'countryId')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Country::find()->all(), 'id', 'name'),
        ['prompt' => '--', 'onchange' => 'this.form.submit()']
    ) ?>

    <? if ($regions) : ?>
        <?= $form->field($regionModel, 'regionId')->dropDownList(
            $regions,
            ['prompt' => '--', 'onchange' => 'this.form.submit()']
        ) ?>

        <? if ($cities) : ?>
            <?= $form->field($model, 'city_id')->dropDownList(
                $cities,
                ['prompt' => '--']
            ) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        <? else: ?>
            <?= Html::a(Yii::t('app', 'Create City'), ['cities/create'], ['class' => 'btn btn-success']) ?>
        <? endif; ?>

    <? else: ?>
        <?= Html::a(Yii::t('app', 'Create Region'), ['regions/create'], ['class' => 'btn btn-success']) ?>
    <? endif; ?>


    <?php
    ActiveForm::end(); ?>

</div>
