<?php

namespace common\models;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "{{%gate}}".
 *
 * @property integer $id
 * @property string $person_id
 * @property string $leave_time
 * @property integer $leave_sentry
 * @property string $leave_host
 * @property string $come_time
 * @property integer $come_sentry
 * @property string $come_host
 * @property integer $type
 * @property integer $has_completed
 */
class Gate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'leave_time', 'leave_sentry', 'leave_host', 'type'], 'required'],
            [['leave_time', 'come_time'], 'safe'],
            [['leave_sentry', 'come_sentry', 'type', 'has_completed'], 'integer'],
            [['person_id', 'leave_host', 'come_host'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'person_id' => '被记录者',
            'leave_time' => '离开时间',
            'leave_sentry' => '离开岗哨',
            'leave_host' => '离开记录人',
            'come_time' => '归来时间',
            'come_sentry' => '归来岗哨',
            'come_host' => '归来记录人',
            'type' => '类型',
            'has_completed' => '是否入营',
        ];
    }

    /**
     * in gate, check whether the person leave or come
     * if leave, just record and give a message.
     * if comeback, decide whether overleave and
     * give a message as reply.
     * @param Sentry $sentry
     * @return array [Gate, message]
     */
    public function checkAndRecord($sentry)
    {
        $gate_uncompleted = self::findOne([
            'person_id' => $this->person_id,
            'has_completed' => false,
        ]);

        if ($gate_uncompleted === null) {
            $this->leave_time = date('Y-m-d H:i:s');
            $this->leave_sentry = $sentry->id;
            $this->leave_host = $sentry->host;
            $message = $this->sentryMessage;
            $this->type = $this->owner->status;
            if ($this->save()) {
                return $message;
            } else {
                $x= $this->getErrors();
                throw new BadRequestHttpException('error');
            }

            return $message;
        } else {
            $gate_uncompleted->come_time = date('Y-m-d H:i:s');
            $gate_uncompleted->come_sentry = $sentry->id;
            $gate_uncompleted->come_host = $sentry->host;
            $gate_uncompleted->has_completed = true;
            $gate_uncompleted->save();
            $gate_uncompleted->owner->setStatus(Status::HERE);
            return $gate_uncompleted->owner->name . '进入营区';
        }
    }

    public function getSentryMessage()
    {
        $sentryMessage = $this->owner->name;
        if ($this->owner->status === Status::HERE) {
            $this->owner->setStatus(Status::TMPLEAVE);
            return $sentryMessage . "临时离开营区";
        }
        return $sentryMessage . Lookup::itemQuery(Status::tableName(), $this->owner->status);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveSentry()
    {
        return $this->hasOne(Sentry::className(), ['id' => 'leave_sentry']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComeSentry()
    {
        return $this->hasOne(Sentry::className(), ['id' => 'come_sentry']);
    }

    /**
     * @return Personinfo instance
     */
    public function getOwner()
    {
        return $this->hasOne(Personinfo::className(), ['id' => 'person_id']);
    }

    /**
     * delete two years ago
     * run at XXXX-01-01 00:10:00
     * @return the number of deleted
     */
    public static function cronYearDeleteOldTraffic()
    {
        return self::deleteAll([
            '<', 'leave_time',
            strtotime('-2 year')
        ]);
    }
}
