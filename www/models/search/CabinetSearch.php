<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cabinet;

/**
 * CabinetSearch represents the model behind the search form of `app\models\Cabinet`.
 */
class CabinetSearch extends Cabinet
{
    public ?string $countryId = null;
    public ?string $regionId = null;
    public ?string $cityId = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'salon_id', 'countryId', 'regionId', 'cityId'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cabinet::find()->joinWith(['country', 'region', 'city']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cabinets.id' => $this->id,
            'salon_id' => $this->salon_id,
            'countries.id' => $this->countryId,
            'regions.id' => $this->regionId,
            'cities.id' => $this->cityId,
        ]);

        $dataProvider->sort->attributes['countryId'] = [
            'asc' => ['countries.name' => SORT_ASC],
            'desc' => ['countries.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['cityId'] = [
            'asc' => ['cities.name' => SORT_ASC],
            'desc' => ['cities.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['regionId'] = [
            'asc' => ['regions.name' => SORT_ASC],
            'desc' => ['regions.name' => SORT_DESC],
        ];

        $query->andFilterWhere(['like', 'cabinets.name', $this->name]);

        return $dataProvider;
    }
}
