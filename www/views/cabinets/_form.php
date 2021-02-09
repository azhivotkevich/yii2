<?php

use app\models\forms\CabinetCreateForm;
use app\models\forms\CityCheckForm;
use app\models\forms\CountryCheckForm;
use app\models\forms\RegionCheckForm;
use app\widgets\StepByStepForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Cabinet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cabinet-form">

    <?= StepByStepForm::widget([
        'steps' => [
            new CountryCheckForm(),
            new RegionCheckForm(),
            new CityCheckForm(),
            new CabinetCreateForm(),
        ],
        'redirect' => function(CabinetCreateForm $model) {
            return Url::to(['cabinets/view', 'id' => $model->id]);
        }
    ]);
    ?>

</div>
