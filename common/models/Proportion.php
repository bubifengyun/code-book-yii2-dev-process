<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%proportion}}".
 *
 * @property integer $id
 * @property string $name
 * @property double $proportion
 */
class Proportion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%proportion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proportion'], 'required'],
            [['id'], 'integer'],
            [['proportion'], 'number'],
            [['name'], 'string', 'max' => 16],
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
            'proportion' => '比例数值',
        ];
    }
}
