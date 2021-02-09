<?php

use app\models\City;
use app\models\Country;
use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Salon */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Salons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salon-index card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
    </div>

    <div class="card-body">
        <p>
            <?= Html::a(Yii::t('app', 'Create Salon'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'countryId',
                    'value' => 'country.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'countryId',
                        ArrayHelper::map(Country::find()->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => '--']
                    )
                ],
                [
                    'attribute' => 'regionId',
                    'value' => 'region.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'regionId',
                        ArrayHelper::map(Region::find()->filterWhere(['country_id' => $searchModel->countryId])->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => '--']
                    )

                ],
                [
                    'attribute' => 'city_id',
                    'value' => 'city.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'city_id',
                        ArrayHelper::map(
                            City::find()->joinWith('region')->filterWhere(
                                [
                                    'region_id' => $searchModel->regionId,
                                    'country_id' => $searchModel->countryId
                                ]
                            )->all(),
                            'id', 'name'),
                        ['class' => 'form-control', 'prompt' => '--']
                    )
                ],
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
