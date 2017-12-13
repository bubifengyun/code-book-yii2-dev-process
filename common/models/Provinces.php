<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%provinces}}".
 *
 * @property integer $id
 * @property string $name
 */
class Provinces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%provinces}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '省',
        ];
    }
}
