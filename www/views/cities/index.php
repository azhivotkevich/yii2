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
<div class="city-index card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => ['class' => 'table-responsive'],
            'columns' => [
                [
                    'attribute' => 'id',
                    'filterInputOptions' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ],
                [
                    'attribute' => 'name',
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
                    'attribute' => 'region_id',
                    'value' => 'region.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'region_id',
                        ArrayHelper::map(Region::find()->filterWhere(['country_id' => $searchModel->countryId])->all(), 'id', 'name'),
                        ['class' => 'form-control form-control-sm', 'prompt' => '--']
                    )
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
