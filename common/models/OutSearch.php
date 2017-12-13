<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Out;

/**
 * OneSearch represents the model behind the search form about `common\models\Out`.
 */
class OutSearch extends Out
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_leave', 'time_come', 'time_cancel', 'tel', 'note'], 'safe'],
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
        $query = Out::find();

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
            'time_leave' => $this->time_leave,
            'time_come' => $this->time_come,
            'time_cancel' => $this->time_cancel,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
