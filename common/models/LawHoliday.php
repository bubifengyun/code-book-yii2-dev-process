<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%law_holiday}}".
 *
 * @property integer $id
 * @property string $name
 */
class LawHoliday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%law_holiday}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'safe']
        ];
    }

    /**
     * if admin has set next year law holiday,
     * return true,
     * else return false.
     */
    public static function hasSetNextYearLawHoliday()
    {
        return self::find()->where([
            '>', 'name',
            date("Y-m-d", strtotime('last day of Dec'))
        ])->exists();
    }

    public static function sendNotify()
    {
        $model = new Message();
        $url = Html::a('这里', ['law-holiday/index']);
        $model->content = "<p>请及时录入明年的法定节假日，谢谢。</p> <p>如果您没有设置，该消息将在每年的如下日子发送给您</p><pre>09-01,10-01,11-01,12-01。在 $url 设置法定节假日</pre><p>无需回复。</p>";
        $model->receiver = Yii::$app->setting->get('receiver_set_nextyear_lawholiday');
        $model->sender = User::CONSOLE_CRON_USER;
        $model->status = Message::UNREAD;
        $model->save();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'name' => '法定假日',
        ];
    }

    /**
     * delete two years ago
     * run at XXXX-01-01 00:10:00
     * @return the number of deleted
     */
    public static function cronYearDeleteOldLawHolidays()
    {
        return self::deleteAll([
            '<', 'name',
            date('Y-m-d', strtotime('-2 years'))
        ]);
    }
}
