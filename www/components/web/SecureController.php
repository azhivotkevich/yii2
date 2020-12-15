<?php

namespace app\components\web;

use app\models\User;
use yii\web\Controller;

class SecureController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        if (\Yii::$app->getUser()->isGuest) {
            $this->redirect('/site/login/');
        }
    }
}