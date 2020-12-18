<?php

use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\City */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'countryId',
                'value' => 'country.name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'countryId',
                    ArrayHelper::map(\app\models\Country::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => '--']
                )
            ],
            [
                'attribute' => 'region_id',
                'value' => 'region.name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'region_id',
                    ArrayHelper::map(Region::find()->filterWhere(['country_id' => $searchModel->countryId])->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => '--']
                )
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
