<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'auth_key', 'access_token', 'password_hash', 'password_reset_token', 'created_at', 'updated_at', 'last_login_at', 'this_login_at', 'last_login_ip4', 'this_login_ip4', 'email', 'job', 'profile', 'avatar'], 'safe'],
            [['role', 'see_unit', 'status'], 'integer'],
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
        $query = User::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'last_login_at' => $this->last_login_at,
            'this_login_at' => $this->this_login_at,
            'role' => $this->role,
            'see_unit' => $this->see_unit,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'last_login_ip4', $this->last_login_ip4])
            ->andFilterWhere(['like', 'this_login_ip4', $this->this_login_ip4])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'profile', $this->profile])
            ->andFilterWhere(['like', 'avatar', $this->avatar]);

        return $dataProvider;
    }
}
