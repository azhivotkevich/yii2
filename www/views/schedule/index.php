<?php

use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Schedules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Daily Schedule'), ['create-daily'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Weekly Schedule'), ['create-weekly'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Monthly Schedule'), ['create-monthly'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cabinet_id',
            'user_id',
            'date',
            'time_from',
            //'time_to',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
