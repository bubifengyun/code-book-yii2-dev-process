<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%follow}}".
 *
 * @property string $uid
 * @property string $fid
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%follow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'fid'], 'required'],
            [['uid', 'fid'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'fid' => 'Fid',
        ];
    }
}
