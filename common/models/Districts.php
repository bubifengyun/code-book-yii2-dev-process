<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%districts}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $cid
 * @property integer $day_path
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%districts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pid', 'cid', 'day_path'], 'required'],
            [['pid', 'cid', 'day_path'], 'integer'],
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
            'name' => '县',
            'pid' => '省',
            'cid' => '市',
            'day_path' => '路途天数',
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
     * @return Cities identity
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cid']);
    }
}
