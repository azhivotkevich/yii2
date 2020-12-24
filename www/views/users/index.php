<?php

use app\models\User;
use yii\bootstrap4\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'first_name',
            'second_name',
            'last_name',
            [
                'attribute' => 'birthday',
                'format' => 'date',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'birthday'
                ])
            ],
            'modified_by',
//            'gender',
            [
                'attribute' => 'gender',
                'value' => function (User $model) {
                    return $model->gender;
                }
            ],
            'created_at:date',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'filter' => Html::activeDropDownList(
                        $searchModel,
                    'status',
                    ArrayHelper::map(User::find()->all(), 'status', 'status'),
                    ['prompt' => '--', 'class' => 'form-control']
                )

//                    ArrayHelper::map(User::find()->all(), 'status', 'status')
            ],

            ['class' => yii\grid\ActionColumn::class],
        ],
    ]); ?>


</div>
