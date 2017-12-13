<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%status}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_occupied_day
 */
class Status extends \yii\db\ActiveRecord
{
    const HERE = 0;
    const OUT = 12;
    const WEEKENDHOME = 13;
    const TMPLEAVE = 3;
    const OVERLEAVE = 15;
    const OVERLEAVE_HOLIDAY = 14;
    const OVERLEAVE_OUT = 15;

    const JUNIOR = 1;
    const OFFICER = 2;
    const ADMIN = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id'], 'safe'],
            [['is_occupied_day'], 'integer'],
            [['name'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '状态编号',
            'name' => '在位状态',
            'is_occupied_day' => '是否计入假期',
        ];
    }

    public static function isOccupy($id)
    {
        $model = self::findOne($id);
        if ($model === null) {
            return true;
        }
        return $model->is_occupied_day;
    }
}
