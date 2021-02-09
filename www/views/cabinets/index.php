<?php

use app\models\City;
use app\models\Region;
use app\models\Salon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CabinetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cabinets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
    </div>
    <div class="card-body">

        <p>
            <?= Html::a(Yii::t('app', 'Create Cabinet'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'filterInputOptions' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ],
                [
                    'attribute' => 'countryId',
                    'value' => 'country.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'countryId',
                        ArrayHelper::map(\app\models\Country::find()->all(), 'id', 'name'),
                        ['class' => 'form-control form-control-sm', 'prompt' => '--']
                    )
                ],
                [
                    'attribute' => 'regionId',
                    'value' => 'region.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'regionId',
                        ArrayHelper::map(Region::find()->filterWhere(['country_id' => $searchModel->countryId])->all(), 'id', 'name'),
                        ['class' => 'form-control form-control-sm', 'prompt' => '--']
                    )
                ],
                [
                    'attribute' => 'cityId',
                    'value' => 'city.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'cityId',
                        ArrayHelper::map(City::find()->joinWith(['country', 'region'])->filterWhere([
                            'region_id' => $searchModel->regionId,
                            'countries.id' => $searchModel->countryId,
                            'regions.id' => $searchModel->regionId,
                        ])->all(), 'id', 'name'),
                        ['class' => 'form-control form-control-sm', 'prompt' => '--']
                    )
                ],
                [
                    'attribute' => 'salon_id',
                    'value' => 'salon.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'salon_id',
                        ArrayHelper::map(Salon::find()->filterWhere(['city_id' => $searchModel->cityId])->all(), 'id', 'name'),
                        ['class' => 'form-control form-control-sm', 'prompt' => '--']
                    )
                ],
                [
                    'attribute' => 'name',
                    'filterInputOptions' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
