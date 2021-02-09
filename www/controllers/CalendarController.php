<?php


namespace app\controllers;

use app\components\web\SecureController;
use app\models\forms\CalendarFilterForm;
use edofre\fullcalendar\models\Event;
use yii\web\JsExpression;

class CalendarController extends SecureController
{

    public function actionIndex()
    {
        $model = new CalendarFilterForm();
        $model->load($this->request->get());

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionEvents($id, $start, $end)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            // minimum
            new Event([
                'title' => 'Appointment #' . rand(1, 999),
                'start' => '2021-03-18T14:00:00',
            ]),
            // Everything editable
            new Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2021-01-15T12:30:00',
                'end'              => '2021-01-15T13:30:00',
                'editable'         => true,
                'startEditable'    => true,
                'durationEditable' => true,
                'allDay' => false
            ]),
            // No overlap
            new Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2021-01-15T15:30:00',
                'end'              => '2021-01-15T19:30:00',
                'overlap'          => false, // Overlap is default true
                'editable'         => true,
                'startEditable'    => true,
                'durationEditable' => true,
            ]),
            // Only duration editable
            new Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2021-01-16T11:00:00',
                'end'              => '2021-01-16T11:30:00',
                'startEditable'    => false,
                'durationEditable' => true,
            ]),
            // Only start editable
            new Event([
                'id'               => uniqid(),
                'title'            => 'Appointment #' . rand(1, 999),
                'start'            => '2021-01-16T14:00:00',
                'end'              => '2021-01-16T15:30:00',
                'startEditable'    => true,
                'durationEditable' => false,
            ]),
        ];
    }
}