<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReadyWar;

/**
 * ReadyWarSearch represents the model behind the search form about `common\models\ReadyWar`.
 */
class ReadyWarSearch extends ReadyWar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ratio_land_officer', 'ratio_air_officer', 'ratio_soldier', 'ratio_officer'], 'integer'],
            [['name', 'begin_date', 'end_date'], 'safe'],
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
        $query = ReadyWar::find();

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
            'ratio_land_officer' => $this->ratio_land_officer,
            'ratio_air_officer' => $this->ratio_air_officer,
            'ratio_soldier' => $this->ratio_soldier,
            'ratio_officer' => $this->ratio_officer,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
