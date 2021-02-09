<?php


namespace app\models\forms;


use app\models\City;
use app\models\Salon;
use app\widgets\StepableFormInterface;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class SalonCreateForm extends Salon implements StepableFormInterface
{

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        $regionId = $completedSteps[RegionCheckForm::class]->regionId ?? null;
        return [
            $form->field($this, 'city_id')->dropDownList(
                ArrayHelper::map(City::find()->filterWhere(['region_id' => $regionId])->all(), 'id', 'name'),
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