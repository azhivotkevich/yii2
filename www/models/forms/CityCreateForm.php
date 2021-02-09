<?php


namespace app\models\forms;


use app\models\City;
use app\models\Region;
use app\widgets\StepableFormInterface;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class CityCreateForm extends City implements StepableFormInterface
{

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        $countryId = $completedSteps[CountryCheckForm::class]->countryId ?? null;
        return [
            $form->field($this, 'region_id')->dropDownList(
                ArrayHelper::map(Region::find()->filterWhere(['country_id' => $countryId])->all(), 'id', 'name'),
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