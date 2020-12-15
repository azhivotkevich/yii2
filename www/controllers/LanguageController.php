<?php


namespace app\controllers;


use app\models\forms\SetLanguageForm;
use yii\web\Controller;

class LanguageController extends Controller
{
    public function actionSet()
    {
        $model = new SetLanguageForm();

        if (!$model->load(\Yii::$app->request->post()) || !$model->set()) {
            \Yii::$app->session->addFlash('error', \Yii::t('app', $model->getFirstError('language')));
        }
        return $this->redirect(\Yii::$app->request->getReferrer());
    }
}