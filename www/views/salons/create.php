<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salon */

$this->title = Yii::t('app', 'Create Salon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-create card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
    </div>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'regions' => $regions,
            'countryModel' => $countryModel,
            'cities' => $cities,
            'regionModel' => $regionModel
        ]) ?>
    </div>

</div>
