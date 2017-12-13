<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cities}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pid'], 'required'],
            [['pid'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @return Provinces identity
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'pid']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '市',
            'pid' => '省',
            'province' => '省',
        ];
    }
}
