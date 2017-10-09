<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Favorite;

/**
 * FavoriteSearch represents the model behind the search form of `common\models\Favorite`.
 */
class FavoriteSearch extends Favorite
{
    public $jobTitle;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'package_id', 'job_id', 'user_id', 'start_date', 'end_date', 'weight', 'active', 'created_at', 'updated_at'], 'integer'],
            ['jobTitle', 'safe']
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
        $query = Favorite::find()->with('job')->with('package')->with('user');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Favorite.id' => $this->id,
            'Favorite.package_id' => $this->package_id,
            'Favorite.job_id' => $this->job_id,
            'Favorite.user_id' => $this->user_id,
            'Favorite.start_date' => $this->start_date,
            'Favorite.end_date' => $this->end_date,
            'Favorite.weight' => $this->weight,
            'Favorite.active' => $this->active,
            'Favorite.created_at' => $this->created_at,
            'Favorite.updated_at' => $this->updated_at,
        ]);

        // filter by country name
        $query->joinWith(['job' => function ($q) {
            $q->where('Job.title LIKE "%' . $this->jobTitle . '%"');
        }]);

        return $dataProvider;
    }
}
