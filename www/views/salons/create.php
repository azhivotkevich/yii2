<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */

$this->title = Yii::t('app', 'Create Salon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'countryModel' => $countryModel,
        'cities' => $cities,
        'regionModel' => $regionModel
    ]) ?>

</div>
