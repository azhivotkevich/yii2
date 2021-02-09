<?php


namespace app\modules\api\controllers;


use yii\rest\Controller;

class ScheduleController extends Controller
{
    public function actionIndex(): array
    {
        return ['hello'];
    }

    public function actionCreateInvoice()
    {
        $data = \Yii::$app->request->post();
    }
}