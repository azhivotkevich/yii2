<?php

use app\models\forms\CityCreateForm;
use app\models\forms\CountryCheckForm;
use app\widgets\StepByStepForm;

/* @var $this yii\web\View */
/* @var $cityModel CityCreateForm */
/* @var $countryModel CountryCheckForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">
    <?= StepByStepForm::widget([
        'steps' => [
            new CountryCheckForm(),
            new CityCreateForm()
        ],
        'redirect' => function(CityCreateForm $model) {
            return \yii\helpers\Url::to(['cities/view', 'id' => $model->id]);
        }
    ]);
    ?>
</div>
