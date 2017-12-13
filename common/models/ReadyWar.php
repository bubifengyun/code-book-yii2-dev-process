<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ready_war}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $begin_date
 * @property string $end_date
 * @property integer $ratio_land_officer
 * @property integer $ratio_air_officer
 * @property integer $ratio_soldier
 * @property integer $ratio_officer
 */
class ReadyWar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ready_war}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'begin_date', 'end_date', 'ratio_soldier', 'ratio_officer'], 'required'],
            [['id', 'ratio_land_officer', 'ratio_air_officer', 'ratio_soldier', 'ratio_officer'], 'integer'],
            [['begin_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '宝贝名称',
            'begin_date' => '开始日期',
            'end_date' => '结束日期',
            'ratio_land_officer' => '落雁在位率',
            'ratio_air_officer' => '飞马在位率',
            'ratio_soldier' => '将士象在位率(%)',
            'ratio_officer' => '车马炮在位率(%)',
        ];
    }

    public static function getEndDate()
    {
        $model = self::findOne(1);
        return $model->end_date;
    }

    public static function getBeginDate()
    {
        $model = self::findOne(1);
        return $model->begin_date;
    }
}
