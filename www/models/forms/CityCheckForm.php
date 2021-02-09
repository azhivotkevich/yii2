<?php


namespace app\models\forms;


use app\models\City;
use app\widgets\StepableFormInterface;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class CityCheckForm extends Model implements StepableFormInterface
{
    public ?string $cityId = null;

    public function rules(): array
    {
        return [
            [['cityId'], 'required'],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['cityId' => 'id']],
        ];
    }

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        $regionId = $completedSteps[RegionCheckForm::class]->regionId ?? null;
        return [
            $form->field($this, 'cityId')->dropDownList(
                ArrayHelper::map(City::find()->filterWhere(['region_id' => $regionId])->all(), 'id', 'name'),
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