<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sentry}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $name
 * @property string $host
 */
class Sentry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sentry}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'name', 'host'], 'required'],
            [['id'], 'integer'],
            [['user_id'], 'string', 'max' => 64],
            [['name', 'host'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'user_id' => '用户',
            'name' => '哨名',
            'host' => '负责人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
