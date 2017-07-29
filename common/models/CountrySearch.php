<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountrySearch represents the model behind the search form of `common\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Code', 'Name', 'Continent', 'Region', 'LocalName', 'GovernmentForm', 'HeadOfState', 'Code2', 'Language_id'], 'safe'],
            [['SurfaceArea', 'LifeExpectancy', 'GNP', 'GNPOld'], 'number'],
            [['IndepYear', 'Population', 'Capital', 'Language_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Country::find();

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
            'SurfaceArea' => $this->SurfaceArea,
            'IndepYear' => $this->IndepYear,
            'Population' => $this->Population,
            'LifeExpectancy' => $this->LifeExpectancy,
            'GNP' => $this->GNP,
            'GNPOld' => $this->GNPOld,
            'Capital' => $this->Capital,
            'Language_id' => $this->Language_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'Code', $this->Code])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Continent', $this->Continent])
            ->andFilterWhere(['like', 'Region', $this->Region])
            ->andFilterWhere(['like', 'LocalName', $this->LocalName])
            ->andFilterWhere(['like', 'GovernmentForm', $this->GovernmentForm])
            ->andFilterWhere(['like', 'HeadOfState', $this->HeadOfState])
            ->andFilterWhere(['like', 'Code2', $this->Code2]);

        return $dataProvider;
    }
}
