<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailySchedule */

$this->title = Yii::t('app', 'Create Daily Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
