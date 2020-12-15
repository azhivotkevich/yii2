<?php


namespace app\commands;

use Yii;
use yii\console\Controller;


class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;


        $admin = $authManager->createRole('admin');

        $authManager->add($admin);

        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $signUp = $authManager->createPermission('sign-up');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);

        $authManager->addChild($admin, $login);
        $authManager->addChild($admin, $logout);
        $authManager->addChild($admin, $index);
        $authManager->addChild($admin, $view);
        $authManager->addChild($admin, $update);
        $authManager->addChild($admin, $delete);

        $authManager->assign($authManager->getRole('admin'), '1');
    }
}