<?php


namespace app\models\forms;


use app\models\City;
use app\models\Region;

class CreateCityForm extends City
{
    public const ADD_COUNTRY_SCENARIO = 'addCountry';
    public const ADD_CITY_SCENARIO = 'addCity';
    public $countryId = null;
    public $currentScenario = self::ADD_COUNTRY_SCENARIO;

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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->currentScenario === self::ADD_COUNTRY_SCENARIO) {
            if ($this->validate()) {
                $this->currentScenario = self::ADD_CITY_SCENARIO;
            }
            return false;
        }

//        return parent::save($runValidation, $attributeNames);
    }

    public function scenarios()
    {
        return [
            self::ADD_COUNTRY_SCENARIO => ['scenario', 'countryId'],
            self::ADD_CITY_SCENARIO => ['scenario', 'countryId', 'region_id', 'name'],
        ];
    }
}