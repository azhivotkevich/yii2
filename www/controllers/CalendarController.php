<?php


namespace app\controllers;

use app\components\web\SecureController;

class CalendarController extends SecureController
{
    public function actionIndex() {
        return $this->render('index', [
        ]);
    }
}