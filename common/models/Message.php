<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property string $create_time
 * @property string $sender
 * @property string $receiver
 */
class Message extends \yii\db\ActiveRecord
{
    const UNREAD = 0;
    const READ = 1;
    const COUNT_LIMITED = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'sender', 'receiver'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
            [['create_time'], 'safe'],
            [['sender', 'receiver'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'status' => '状态',
            'create_time' => '发送时间',
            'sender' => '发信人',
            'receiver' => '收信人',
        ];
    }

    public static function setIHaveReadAll($messages)
    {
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($messages as $message) {
            $message->setIHaveRead();
        }
        $transaction->commit();
    }

    public function setIHaveRead()
    {
        if ($this->receiver === Yii::$app->user->identity->id) {
            $this->status = self::READ;
            $this->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSendUser()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->create_time = Yii::$app->formatter->asDate(time(), 'php:Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete two years ago
     * run at XXXX-01-01 00:10:00
     * @return the number of deleted
     */
    public static function cronYearDeleteOldMessages()
    {
        return self::deleteAll([
            '<', 'create_time',
            date('Y-m-d H:i:s', strtotime('-2 years'))
        ]);
    }

    /**
     * say happy new year to every user.
     * run at XXXX-01-01 00:10:00
     * @return the number of messages
     */
    public static function cronYearHappyNewYear()
    {
        $users = User::findAll([
            'status' => User::STATUS_ACTIVE,
        ]);

        $thisyear = date('Y');

        $transaction = Yii::$app->db->beginTransaction();
        foreach ($users as $user) {
            $message = new Message();
            $message->content =
                "<pre>祝您在 $thisyear 年里，
                家庭幸福，
                身体健康，
                开心快乐，
                工作顺利，
                事业有成。 
                人员管理网站恭贺。</pre>";
            $message->sender = User::CONSOLE_CRON_USER;
            $message->status = Message::UNREAD;
            $message->isNewRecord = true;
            $message->receiver = $user->id;
            $message->save();
        }
        $transaction->commit();
    }
}
