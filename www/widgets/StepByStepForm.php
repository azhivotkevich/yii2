<?php


namespace app\widgets;


use Closure;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\bootstrap4\Html;
use yii\bootstrap4\Widget;
use yii\widgets\ActiveForm;

class StepByStepForm extends Widget
{
    /**
     * @var StepableFormInterface[]|Model[]
     */
    public array $steps = [];
    public ?Closure $redirect = null;

    public function run()
    {
        if (!$this->steps) {
            throw new InvalidConfigException('Steps are required');
        }

        $completedSteps = [];

        $form = ActiveForm::begin();
        foreach ($this->steps as $step) {

            $step->load(Yii::$app->request->post());
            $isValid = $step->validate();

            foreach ($step->getFields($form, $completedSteps) as $field) {
                echo $field;
            }

            if ($step->hasSubmitButton()) {
                echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
            }

            if (!$isValid) {
                break;
            }

            $completedSteps[get_class($step)] = $step;
            $isLastStep = count($completedSteps) === count($this->steps);

            if ($step->isSavable() && $step->save() && $isLastStep && $this->redirect) {
                $redirectUrl = call_user_func_array($this->redirect, [$step]);
                Yii::$app->getResponse()->redirect($redirectUrl);
                Yii::$app->getResponse()->send();
            }

        }

        ActiveForm::end();
    }

    public function beforeRun(): bool
    {
        foreach ($this->steps as $step) {
            if (!$step instanceof StepableFormInterface) {
                throw new InvalidConfigException('All steps must should implement StepableFormInterface');
            }
        }
        return parent::beforeRun();
    }
}