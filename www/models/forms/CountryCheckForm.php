<?php


namespace app\models\forms;


use app\models\Country;
use app\widgets\StepableFormInterface;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class CountryCheckForm extends Model implements StepableFormInterface
{
    public ?string $countryId = null;

    public function rules()
    {
        return [
            [
                ['countryId'], 'required'],
            [
                ['countryId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Country::class,
                'targetAttribute' => ['countryId' => 'id']
            ],
        ];
    }

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        return [
            $form->field($this, 'countryId')->dropDownList(
                ArrayHelper::map(Country::find()->all(), 'id', 'name'),
                ['prompt' => '--', 'onchange' => 'this.form.submit()']
            )
        ];
    }

    public function hasSubmitButton(): bool
    {
        return false;
    }

    public function isSavable(): bool
    {
        return false;
    }
}