<?php use app\models\forms\SetLanguageForm;
use yii\bootstrap4\ActiveForm;

/**
 * @var SetLanguageForm $model
 */

$form = ActiveForm::begin(['action' => '/language/set', 'method' => 'POST']); ?>

<?= $form->field($model, 'language')->dropdownList(
    Yii::$app->params['languages'],
    ['onchange' => 'this.form.submit()']
) ?>

<?php ActiveForm::end(); ?>