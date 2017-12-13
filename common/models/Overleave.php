<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%overleave}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $ps
 */
class Overleave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%overleave}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'ps'], 'required'],
            [['type'], 'integer'],
            [['id'], 'string', 'max' => 32],
            [['ps'], 'string', 'max' => 72]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '身份证',
            'type' => '类型',
            'ps' => '备注',
        ];
    }
}
