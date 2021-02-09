<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\forms\SignUpDoctorForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup as Doctor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'birthday')->widget(\kartik\date\DatePicker::class) ?>

    <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'second_name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'gender')->dropdownList(['male' => 'male', 'female' => 'female']) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
