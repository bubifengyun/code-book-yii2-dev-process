<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%person_apply}}".
 *
 * @property integer $id
 * @property integer $apply_type
 */
class PersonApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person_apply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'apply_type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'apply_type' => '申请类型',
        ];
    }
}
