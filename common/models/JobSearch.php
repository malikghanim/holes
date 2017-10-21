<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Job;
use common\models\Favorite;

/**
 * JobSearch represents the model behind the search form of `common\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'working_from', 'working_to', 'category_id', 'city_id', 'user_id'], 'integer'],
            [['title', 'description', 'mobile', 'CountryCode', 'status'], 'safe'],
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
        if(Yii::$app->controllerNamespace != 'backend\controllers')
            $query = Job::find()->with('favorite')->orderBy(['weight' => SORT_DESC, '`Job`.created_at' => SORT_DESC]);
        else
            $query = Job::find();

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
            '`Job`.id' => $this->id,
            '`Job`.working_from' => $this->working_from,
            '`Job`.working_to' => $this->working_to,
            '`Job`.category_id' => $this->category_id,
            '`Job`.city_id' => $this->city_id,
            '`Job`.user_id' => $this->user_id,
            '`Job`.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', '`Job`.title', $this->title])
            ->andFilterWhere(['like', '`Job`.description', $this->description])
            ->andFilterWhere(['like', '`Job`.mobile', $this->mobile])
            ->andFilterWhere(['like', '`Job`.CountryCode', $this->CountryCode]);

        return $dataProvider;
    }
}
