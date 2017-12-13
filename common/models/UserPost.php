<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_post}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $org
 */
class UserPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'type'], 'integer'],
            [['name', 'org'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'type' => '类型',
            'name' => '名称',
            'org' => '组织',
        ];
    }
}
