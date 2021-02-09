<?php


namespace app\models\forms;


use app\models\City;
use app\models\Region;

class CreateCityForm extends City
{
    public $countryId = null;

    public function rules()
    {
        return [
            [['region_id', 'name', 'countryId'], 'required'],
            [['region_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }
}