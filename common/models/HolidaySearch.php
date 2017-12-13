<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Holiday;

/**
 * HolidaySearch represents the model behind the search form about `common\models\Holiday`.
 */
class HolidaySearch extends Holiday
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h_id', 'kind'], 'integer'],
            [['id', 'date_leave', 'which_year', 'date_come', 'date_cancel', 'boss_id', 'where_leave', 'tel', 'paper'], 'safe'],
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
        $query = Holiday::find();

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
            'h_id' => $this->h_id,
            'date_leave' => $this->date_leave,
            'which_year' => $this->which_year,
            'date_come' => $this->date_come,
            'date_cancel' => $this->date_cancel,
            'kind' => $this->kind,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'boss_id', $this->boss_id])
            ->andFilterWhere(['like', 'where_leave', $this->where_leave])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'paper', $this->paper]);

        return $dataProvider;
    }
}
