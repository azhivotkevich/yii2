<?php


namespace app\models\forms;


use app\models\Country;
use yii\base\Model;

class CountryCheckForm extends Model
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
}