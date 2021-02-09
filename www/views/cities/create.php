<?php

use app\models\forms\CityCreateForm;
use app\models\forms\CountryCheckForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $cityModel CityCreateForm */
/* @var $countryModel CountryCheckForm */

$this->title = Yii::t('app', 'Create City');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'cityModel' => $cityModel,
//        'regions' => $regions,
        'countryModel' => $countryModel
    ]) ?>

</div>
