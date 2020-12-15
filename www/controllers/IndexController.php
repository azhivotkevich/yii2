<?php


namespace app\controllers;


use app\components\web\SecureController;

class IndexController extends SecureController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}