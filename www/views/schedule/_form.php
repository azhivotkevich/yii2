<?php

use app\models\DailySchedule;
use app\models\MonthlySchedule;
use app\models\User;
use app\models\WeeklySchedule;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;
use kartik\time\TimePicker;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model DailySchedule|WeeklySchedule|MonthlySchedule */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="daily-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cabinetId')->dropDownList(
            ArrayHelper::map(\app\models\Cabinet::find()->all(), 'id', 'name'),
        ['prompt' => '--']
    ) ?>

    <?php
    if (!Yii::$app->user->can('doctor')) {
        echo $form->field($model, 'userId')->dropDownList(
            ArrayHelper::map(User::find()->doctors()->all(), 'id', function ($data) {
                if ($data['first_name'] && $data['second_name'] && $data['last_name']) {
                    return "{$data['last_name']} {$data['first_name']} {$data['last_name']}";
                }
                return $data['username'];
            }),
            ['prompt' => '--']
        );
    }
    ?>

    <?php switch ($model->scenario) {
        case \app\models\forms\ScheduleForm::DAILY_SCHEDULE:
//            echo $form->field($model, 'date')->widget(\kartik\date\DatePicker::class);
            echo $form->field($model, 'dates')->widget(MultipleInput::class, [
                'columns' => [
                    [
                        'name'  => 'date',
                        'title'  => Html::activeLabel($model, 'date'),
                        'type'  => \kartik\date\DatePicker::class,
                        'enableError' => true,
                        'value' => function($data) {
                            return $data['date'] ?? null;
                        },
                        'options' => [
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy',
                                'todayHighlight' => true
                            ]
                        ]
                    ],
                    [
                        'name'  => 'time_from',
                        'title'  => Html::activeLabel($model, 'time_from'),
                        'type'  => TimePicker::class,
                        'enableError' => true,
                        'value' => function($data) {
                            return $data['time_from'] ?? null;
                        },
                        'options' => [
                            'pluginOptions' => [
                                'showMeridian' => false,
                                'showSeconds' => false
                            ]
                        ]
                    ],
                    [
                        'name'  => 'time_to',
                        'title'  => Html::activeLabel($model, 'time_to'),
                        'type'  => TimePicker::class,
                        'enableError' => true,
                        'value' => function($data) {
                            return $data['time_to'] ?? null;
                        },
                        'options' => [
                            'pluginOptions' => [
                                'showMeridian' => false,
                                'showSeconds' => false
                            ]
                        ]
                    ]
            ]])->label(false);
            break;
        case \app\models\forms\ScheduleForm::WEEKLY_SCHEDULE:
            echo $form->field($model, 'day')->dropDownList(\app\helpers\CalendarHelper::getWeekDaysList());
            break;
        case \app\models\forms\ScheduleForm::MONTHLY_SCHEDULE:
            echo $form->field($model, 'day')->dropDownList(\app\helpers\CalendarHelper::getMonthDatesList());
            break;

    } ?>

    <?php
    if (!Yii::$app->user->can('doctor')) {
        echo $form->field($model, 'status')->dropDownList(
            [
                'new' => 'New',
                'active' => 'Active',
                'disabled' => 'Disabled',
            ]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
