<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%person_apply_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $local
 * @property integer $id_status
 */
class PersonApplyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person_apply_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'local', 'id_status'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'name' => '名称',
            'local' => '是否本地',
            'id_status' => 'status_id',
        ];
    }
}
