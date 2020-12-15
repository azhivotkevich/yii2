<?php

namespace app\components\web;

use app\models\User;
use yii\web\Controller;

class GuestController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
//        var_dump(\Yii::$app->getUser()->isGuest); exit();
        parent::__construct($id, $module, $config);

        if (!\Yii::$app->getUser()->isGuest) {
            $this->redirect('/');
        }
    }
}