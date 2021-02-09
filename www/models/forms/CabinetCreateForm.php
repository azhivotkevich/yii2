<?php


namespace app\models\forms;


use app\models\Cabinet;
use app\models\Salon;
use app\widgets\StepableFormInterface;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class CabinetCreateForm extends Cabinet implements StepableFormInterface
{

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        $cityId = $completedSteps[CityCheckForm::class]->cityId ?? null;
        return [
            $form->field($this, 'salon_id')->dropDownList(
                ArrayHelper::map(Salon::find()->filterWhere(['city_id' => $cityId])->all(), 'id', 'name'),
                ['prompt' => '--', 'onchange' => 'this.form.submit()']
            ),
            $form->field($this, 'name')->textInput(['maxlength' => true])
        ];
    }

    public function hasSubmitButton(): bool
    {
        return true;
    }

    public function isSavable(): bool
    {
        return true;
    }
}