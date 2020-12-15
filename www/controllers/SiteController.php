<?php

namespace app\controllers;

use app\components\web\GuestController;
use app\models\forms\LoginForm;
use app\models\forms\SignUpClientForm;
use app\models\forms\SignUpDoctorForm;
use Yii;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends GuestController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/');
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignUpDoctor()
    {
        $model = new SignUpDoctorForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect('/site/login');
        }

        return $this->render('sign-up-doctor', [
            'model' => $model
        ]);
    }

    public function actionSignUpClient()
    {
        $model = new SignUpClientForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect('/site/login');
        }

        return $this->render('sign-up-client', [
            'model' => $model
        ]);
    }

    public function actionSignUp()
    {
        return $this->render('sign-up');
    }
}
