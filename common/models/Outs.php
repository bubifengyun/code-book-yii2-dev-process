<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%outs}}".
 *
 * @property integer $o_id
 * @property string $id
 * @property string $time_leave
 * @property string $time_cancel
 * @property string $note
 */
class Outs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%outs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['time_leave', 'time_cancel'], 'safe'],
            [['id', 'note'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'o_id' => '编号',
            'id' => '身份证',
            'time_leave' => '离开时间',
            'time_cancel' => '销假时间',
            'note' => '外出原因',
        ];
    }

    /**
     * record one Out object.
     * @param $out Out object
     * @return boolen whether save successful.
     */
    public static function record($out)
    {
        $model =new Outs;
        $model->id = $out->id;
        $model->time_leave = $out->time_leave;
        $model->time_cancel = $out->time_cancel;
        $model->note = $out->note;
        return $model->save();
    }

    public static function records($out, $person_ids)
    {
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($person_ids as $person_id) {
            $out->id = $person_id;
            self::Record($out);
        }
        $transaction->commit();
    }

    /**
     * delete two years ago
     * run at XXXX-01-01 00:10:00
     * @return the number of deleted
     */
    public static function cronYearDeleteOldRecords()
    {
        return self::deleteAll([
            '<', 'time_leave',
            strtotime('-2 year')
        ]);
    }
}
