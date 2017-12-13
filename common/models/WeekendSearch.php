<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Weekend;

/**
 * WeekendSearch represents the model behind the search form about `common\models\Weekend`.
 */
class WeekendSearch extends Weekend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'default_begin_weekday', 'default_end_weekday'], 'integer'],
            [['begin_date', 'end_date'], 'safe'],
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
        $query = Weekend::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
            'default_begin_weekday' => $this->default_begin_weekday,
            'default_end_weekday' => $this->default_end_weekday,
        ]);

        return $dataProvider;
    }
}
