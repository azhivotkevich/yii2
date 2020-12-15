<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\forms\SignUpDoctorForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please tell us who you are:</p>

    <?=Html::a("I'm a Doctor", '/site/sign-up-doctor'); ?> <span> / </span>
    <?=Html::a("I'm a Client", '/site/sign-up-client'); ?>
</div>
