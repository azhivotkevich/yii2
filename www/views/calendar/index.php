<?php

/* @var $this yii\web\View */

/* @var $model app\models\forms\CalendarFilterForm */

use app\helpers\ParamsHelper;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = Yii::t('app', 'Calendar');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="city-index card shadow mb-4">
    <div class="card-body">
        <?= $this->render('_form', ['model' => $model]); ?>
    </div>
</div>
<div class="city-index card shadow mb-4">
    <div class="card-body">
        <?= edofre\fullcalendar\Fullcalendar::widget([
            'options' => [
                'id' => 'calendar',
                'language' => ParamsHelper::getLanguageShortcut(),
            ],
            'header' => [
                'left' => 'today',
                'center' => 'prev title next',
                'right' => 'month,agendaWeek,agendaDay'
            ],
            'clientOptions' => [
                'weekNumbers' => true,
                'selectable' => true,
                'defaultView' => 'agendaDay',
                'allDaySlot' => false,
                'scrollTime' => '00:00',

                'eventResize' => new JsExpression(
                    "function(event, delta, revertFunc) {
                            alert(event.title + 'end is now ' + event.end.format());

                            if (!confirm('is this okay?')) {
                              revertFunc();
                            }
                        }"),
                'eventClick' => new JsExpression(
                    "function(event, jsEvent, view) {
                            alert('Event: ' + event.title);
                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                            alert('View: ' + view.name);
                        
                            // change the border color just for fun
                            $(this).css('border-color', 'red');
                        }"
                ),
                'select' => new JsExpression(
                    "function(start, end, jsEvent, view) {
                    $('#create-event').modal('show');
                            alert('Start: ' + start);
                            alert('Start: ' + end);
                        }"
                )
            ],
            'events' => Url::to(['calendar/events', 'id' => uniqid()]),
        ]);?>

        <?php
        yii\bootstrap4\Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'centerVertical' => true,
            'id' => 'create-event',
            'size' => 'modal-lg',
            'closeButton' => [
                'id'=>'close-button',
                'class'=>'close',
                'data-dismiss' =>'modal',
            ],
            'clientOptions' => [
                'backdrop' => false, 'keyboard' => true
            ],
            'footer' => 's'
        ]);?>
        <div id='modalContent'>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field(new \app\models\DailySchedule, 'cabinet_id')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <?yii\bootstrap4\Modal::end();
        ?>
    </div>
</div>
