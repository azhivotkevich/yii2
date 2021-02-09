<?php


namespace app\models\forms;


use app\models\Region;
use app\widgets\StepableFormInterface;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class RegionCheckForm extends Model implements StepableFormInterface
{
    public ?string $regionId = null;

    public function rules(): array
    {
        return [
            [['regionId'], 'required'],
            [['regionId'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['regionId' => 'id']],
        ];
    }

    public function getFields(ActiveForm $form, array $completedSteps): array
    {
        $countryId = $completedSteps[CountryCheckForm::class]->countryId ?? null;
        return [
            $form->field($this, 'regionId')->dropDownList(
                ArrayHelper::map(Region::find()->filterWhere(['country_id' => $countryId])->all(), 'id', 'name'),
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