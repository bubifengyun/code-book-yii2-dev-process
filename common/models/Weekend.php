<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%weekend}}".
 *
 * @property integer $id
 * @property string $begin_date
 * @property string $end_date
 * @property string $default_begin_weekday
 * @property string $default_end_weekday
 */
class Weekend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%weekend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'begin_date', 'end_date'], 'required'],
            [['id'], 'integer'],
            [['begin_date', 'end_date', 'default_begin_weekday', 'default_end_weekday'], 'safe']
        ];
    }

    public static function getBeginTimestamp()
    {
        $model = self::findOne(1);
        return strtotime($model->begin_date);
    }

    public static function getEndTimestamp()
    {
        $model = self::findOne(1);
        return strtotime($model->end_date);
    }

    /**
     * 每周周末结束的时候自动运行。
     * 本周的开始日期和结束日期已经无用了。
     * 则自动把下周的周末移至本周，
     * 下周周末默认为本周的七天后。
     */
    public static function defaultRun()
    {
        $model = self::findOne(1);
        if ($model === null) {
            return;
        }
        $model->begin_date = date(
            'Y-m-d H:i:s',
            strtotime($model->begin_date
                . ' +7 day')
        );
        $model->end_date = date(
            'Y-m-d H:i:s',
            strtotime($model->end_date
                . ' +7 day')
        );
        $model->save();

        Cronjob::dealWeekend($model);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'begin_date' => '开始日期',
            'end_date' => '结束日期',
            'default_begin_weekday' => '默认开始星期某天',
            'default_end_weekday' => '默认结束星期某天',
        ];
    }
}
