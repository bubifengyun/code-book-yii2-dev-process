<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%out}}".
 *
 * @property string $id
 * @property string $time_leave
 * @property string $time_come
 * @property string $time_cancel
 * @property string $tel
 * @property string $note
 */
class Out extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%out}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['time_leave', 'time_come', 'time_cancel'], 'safe'],
            [['id', 'tel', 'note'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '身份证',
            'time_leave' => '离开时间',
            'time_come' => '回来时间',
            'time_cancel' => '销假时间',
            'tel' => '电话',
            'note' => '外出原因',
        ];
    }

    /**
     * if someone had no out table, create for it.
     * @param $person_ids array Personinfo id
     * @return mixed
     */
    public static function checkAllHadOut($person_ids)
    {
        $countHadOut = self::find()
            ->where(['id' => $person_ids])
            ->count();
        $countPerson = count($person_ids);
        if ($countHadOut === $countPerson) {
            return true;
        }

        $personHadOut_tmp = self::find()
            ->select('id')
            ->where(['id' => $person_ids])
            ->asArray()
            ->all();

        $personHadOut = [];
        foreach ($personHadOut_tmp as $person) {
            $personHadOut[] = $person['id'];
        }
            
        $personHadNoOut = array_diff($person_ids, $personHadOut);
        $out = new Out();
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($personHadNoOut as $person) {
            $out->id = $person;
            $out->loadDefault();
            $out->save();
        }
        $transaction->commit();
        return count($personHadNoOut);
    }

    public function loadDefault()
    {
        $this->time_leave = date('Y-m-d H:i:s');
        $this->time_come = date('Y-m-d H:i:s');
    }

    /**
     * @param $person_ids array Personinfo id
     * @return Personinfo instance
     */
    public function cloneToOthers($person_ids)
    {
        Out::checkAllHadOut($person_ids);
        return Out::updateAll(
            [
                'time_leave' => $this->time_leave,
                'time_come' => $this->time_come,
                'time_cancel' => $this->time_cancel,
                'note' => $this->note,
            ],
            [
                'id' => $person_ids,
            ]
        );
    }

    /**
     * @return Personinfo instance
     */
    public function getOwner()
    {
        return $this->hasOne(Personinfo::className(), ['id' => 'id']);
    }
}
