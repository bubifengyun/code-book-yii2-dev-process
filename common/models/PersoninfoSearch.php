<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Personinfo;

/**
 * PersoninfoSearch represents the model behind the search form about `common\models\Personinfo`.
 */
class PersoninfoSearch extends Personinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'namepinyin', 'sex', 'mil_rank', 'status', 'unit_code', 'is_married', 'property', 'photo', 'can_home_weekend', 'birthdate', 'armydate', 'current_mil_rank_date', 'next_mil_rank_date', 'current_techgrade_date', 'next_techgrade_date', 'current_other_date', 'next_other_date', 'tech_grade', 'job', 'tel'], 'safe'],
            [['myhome_province', 'myhome_city', 'myhome_district', 'parentshome_province', 'parentshome_city', 'parentshome_district'], 'integer'],
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
        $query = Personinfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        PublicFunction::sortByPinyin($dataProvider, [
            'name',
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // if many status combine
        if (is_string($this->status)) {
            if (strpos($this->status, ',') !== false) {
                $this->status = explode(',', $this->status);
            }
        }
        if (is_string($this->mil_rank)) {
            if (strpos($this->mil_rank, ',') !== false) {
                $this->mil_rank = explode(',', $this->mil_rank);
            }
        }

        $query->andFilterWhere([
            'birthdate' => $this->birthdate,
            'armydate' => $this->armydate,
            'current_mil_rank_date' => $this->current_mil_rank_date,
            'next_mil_rank_date' => $this->next_mil_rank_date,
            'current_techgrade_date' => $this->current_techgrade_date,
            'next_techgrade_date' => $this->next_techgrade_date,
            'current_other_date' => $this->current_other_date,
            'next_other_date' => $this->next_other_date,
            'status' => $this->status,
            'mil_rank' => $this->mil_rank,
            'unit_code' => $this->unit_code,
            'myhome_province' => $this->myhome_province,
            'myhome_city' => $this->myhome_city,
            'myhome_district' => $this->myhome_district,
            'parentshome_province' => $this->parentshome_province,
            'parentshome_city' => $this->parentshome_city,
            'parentshome_district' => $this->parentshome_district,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'namepinyin', $this->namepinyin])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'is_married', $this->is_married])
            ->andFilterWhere(['like', 'property', $this->property])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'can_home_weekend', $this->can_home_weekend])
            ->andFilterWhere(['like', 'tech_grade', $this->tech_grade])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}
