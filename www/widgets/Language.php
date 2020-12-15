<?php
namespace app\widgets;

use app\models\forms\SetLanguageForm;
use Yii;

class Language extends \yii\bootstrap4\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $model = new SetLanguageForm();
        $model->language = Yii::$app->language;
        echo $this->render('language', ['model' => $model]);
    }
}
