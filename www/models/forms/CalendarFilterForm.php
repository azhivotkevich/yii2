<?php


namespace app\models\forms;


use app\models\Cabinet;
use app\models\City;
use app\models\Country;
use app\models\Region;
use app\models\Salon;
use Exception;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class CalendarFilterForm extends Model
{
    public ?string $countryId = null;
    public ?string $regionId = null;
    public ?string $cityId = null;
    public ?string $salonId = null;
    public ?string $cabinetId = null;

    public function getDataMap()
    {
        return [
            'countryId' => ['model' => Country::class, 'condition' => []],
            'regionId' => ['model' => Region::class, 'condition' => ['country_id' => 'countryId']],
            'cityId' => ['model' => City::class, 'condition' => ['region_id' => 'regionId']],
            'salonId' => ['model' => Salon::class, 'condition' => ['city_id' => 'cityId']],
            'cabinetId' => ['model' => Cabinet::class, 'condition' => ['salon_id' => 'salonId']],
        ];
    }

    public function rules()
    {
        return [
            [['countryId', 'regionId', 'cityId', 'salonId', 'cabinetId'], 'required'],
        ];
    }

    public function load($data, $formName = null)
    {
        parent::load($data, $formName);

        foreach ($this->getDataMap() as $key => $relations) {
            $this->setValidValue($key, $relations['model'], $relations['condition']);
        }
    }

    /**
     * @param string $key
     * @param ActiveRecord $model
     * @param array $where
     * @return void
     * @throws Exception
     */

    private function setValidValue(string $key, string $model, array $where = []): void
    {
        $conditions = [];
        foreach ($where as $column => $attribute) {
            $conditions[$column] = $this->{$attribute};
        }

        $isValid = $this->{$key} && $model::find()->where(['id' => $this->{$key}])->andFilterWhere($conditions)->limit(1)->exists();

        if ($isValid) {
            return;
        }

        $this->{$key} = $model::find()->select('id')->filterWhere($conditions)->limit(1)->scalar();
    }

    public function getCountries(): array
    {
        return ArrayHelper::map(Country::find()->all(), 'id', 'name');
    }


    public function getRegions(): array
    {
        return ArrayHelper::map(Region::find()->where(['country_id' => $this->countryId])->all(), 'id', 'name');
    }

    public function getCities(): array
    {
        return ArrayHelper::map(City::find()->where(['region_id' => $this->regionId])->all(), 'id', 'name');
    }

    public function getSalons(): array
    {
        return ArrayHelper::map(Salon::find()->where(['city_id' => $this->cityId])->all(), 'id', 'name');
    }

    public function getCabinets(): array
    {
        return ArrayHelper::map(Cabinet::find()->where(['salon_id' => $this->salonId])->all(), 'id', 'name');
    }

    public function attributeLabels(): array
    {
        return [
            'countryId' => \Yii::t('app', 'Country'),
            'regionId' => \Yii::t('app', 'Region'),
            'cityId' => \Yii::t('app', 'City'),
        ];
    }
}