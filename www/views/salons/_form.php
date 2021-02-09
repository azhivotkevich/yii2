<?php

use app\models\forms\CountryCheckForm;
use app\models\forms\RegionCheckForm;
use app\models\forms\SalonCreateForm;
use app\widgets\StepByStepForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salon-form">

    <?= StepByStepForm::widget([
        'steps' => [
            new CountryCheckForm(),
            new RegionCheckForm(),
            new SalonCreateForm()
        ],
        'redirect' => function(SalonCreateForm $model) {
            return Url::to(['salons/view', 'id' => $model->id]);
        }
    ]);
    ?>

</div>
