<?php

use yii\bootstrap4\Tabs;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailySchedule */

$this->title = Yii::t('app', 'Create Daily Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Daily',
                'url' => '/schedule/create-daily',
            ],
            [
                'label' => 'Weekly',
                'content' => $this->render('../_form', [
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'label' => 'Monthly',
                'url' => '/schedule/create-monthly',
            ],
        ],
    ]);
    ?>

</div>
