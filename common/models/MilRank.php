<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%mil_rank}}".
 *
 * @property integer $id
 * @property string $name
 */
class MilRank extends \yii\db\ActiveRecord
{
    const LOWESTMOFFICER = 10; //
    const LOWESTSSOLDIER = 3; //
    const LOWESTENLISTED = 1;//
    const STUDENTSOLDIER = 0;//
    const STUDENTOFFICER = 20;//

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mil_rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '级别编号',
            'name' => '级别',
        ];
    }
}
