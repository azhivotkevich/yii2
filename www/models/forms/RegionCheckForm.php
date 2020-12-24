<?php


namespace app\models\forms;


use app\models\Country;
use app\models\Region;
use yii\base\Model;

class RegionCheckForm extends Model
{
    public ?string $regionId = null;

    public function rules(): array
    {
        return [
            [['regionId', 'regionId'], 'required'],
            [['regionId'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['regionId' => 'id']],
        ];
    }
}