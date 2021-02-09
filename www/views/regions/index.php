<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Region */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
    </div>
    <div class="card-body">

        <p>
            <?= Html::a(Yii::t('app', 'Create Region'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'country_id',
                    'value' => 'country.name',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'country_id',
                        \yii\helpers\ArrayHelper::map(\app\models\Country::find()->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => '--']
                    )
                ],
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
