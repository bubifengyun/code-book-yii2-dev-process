<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\db\Query;

/**
 * This is the model class for table "{{%holiday}}".
 *
 * @property integer $h_id
 * @property string $id
 * @property string $date_leave
 * @property string $which_year
 * @property string $date_come
 * @property string $date_cancel
 * @property string $boss_id
 * @property string $where_leave
 * @property string $tel
 * @property integer $kind
 * @property string $paper
 */
class Holiday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%holiday}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_leave', 'where_leave', 'tel', 'kind'], 'required'],
            [['date_leave', 'which_year', 'date_come', 'date_cancel'], 'safe'],
            [['kind'], 'integer'],
            [['id', 'boss_id', 'where_leave', 'tel'], 'string', 'max' => 32],
            [['paper'], 'string', 'max' => 64],
            [['date_come'], 'checkComeDay'],
            [['date_cancel'], 'checkCancelDay'],
        ];
    }

    /**
     * come date must be later than leave date
     * and total number leaving day must be less than
     * days_left of owner.
     */
    public function checkComeDay()
    {
        if (self::compareDate($this->date_come, $this->date_leave)) {
            $this->addError('date_come', '归队日期必须要比离队日期晚');
            return false;
        }

        if (Status::isOccupy($this->kind)) {
            $owner = $this->owner;
            $day_left = $owner->statisticsHoliday->day_left;
            $day_min_holiday =
                $owner->isSoldier ?
                Yii::$app->setting->get('day_soldier_min_holiday') :
                Yii::$app->setting->get('day_officer_min_holiday');

            if ($day_left < $day_min_holiday) {
                $this->addError('date_come', "您还剩 $day_left 天假期，按照规定，无法休假！");
            }
            $date_latest = $this->latestComeDate;
            if (!self::compareDate($this->date_come, $date_latest)) {
                $this->addError('date_come', '归队日期不得晚于'
                    . $date_latest);
                return false;
            }
        }
    }

    public function getLatestComeDate()
    {
        if (Status::isOccupy($this->kind)) {
            $day_left = $this->owner->statisticsHoliday->day_left;
            return self::dateAfterDateByDays($this->date_leave, $day_left);
        }
        return $this->date_come;
    }

    public function checkCancelDay()
    {
        if ($this->date_cancel===null) {
            return true;
        }

        if (self::compareDate($this->date_cancel, $this->date_leave)) {
            $this->addError('date_cancel', '销假日期必须要比离队日期晚');
        }
    }

    /**
     * @return boolen
     */
    public function getIsOverleave()
    {
        if ($this->date_come == null) {
            return false;
        }
        if (Status::isOccupy($this->kind)) {
            if ($this->date_cancel !== null) {
                return !self::compareDate(
                    $this->date_cancel,
                    $this->date_latest
                );
            } else {
                return !self::compareDate(
                    date('Y-m-d'), //today
                    $this->date_latest
                );
            }
        } else {
            return !self::compareDate(
                $this->date_cancel,
                $this->date_come
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'h_id' => '假表编号',
            'id' => '身份证',
            'date_leave' => '离队日期',
            'which_year' => '哪年假',
            'date_come' => '归队日期',
            'date_cancel' => '销假日期',
            'boss_id' => '负责人',
            'where_leave' => '休假去向',
            'tel' => '电话',
            'kind' => '在外类型',
            'paper' => '纸质表照片',
            'ps' => '备注',
        ];
    }

    public static function setRecordedForUnrecord()
    {
        self::updateAll(
            ['report_month' => date('m')],
            ['report_month' => 0]
        );
    }

    /**
     * @return Personinfo instance
     */
    public function getOwner()
    {
        return $this->hasOne(Personinfo::className(), ['id' => 'id']);
    }

    public function getIsLastyearWhenleave()
    {
        return $this->which_year == (date('Y') -1);
    }

    /**
     * if $date1 is earlier than $date2 return true
     * else false.
     * @param date $date1,
     * @param date $date2
     * @return boolen
     */
    private static function compareDate($date1, $date2)
    {
        $timestamp_date1 = strtotime($date1);
        $timestamp_date2 = strtotime($date2);

        return $timestamp_date1 <= $timestamp_date2;
    }

    /**
     * calculate two date's days removing law holiday
     * @param date $date1,
     * @param date $date2
     * @return integer the number days of $date1 -> $date2
     */
    private static function daysBetweenDates($date1, $date2)
    {
        /*
        if (!self::compareDate($date1, $date2)){
            return -1 * self::daysBetweenDates($date2, $date1);
        }
         */
        $secondOfOneDay=86400;
        $timestamp_date1 = strtotime($date1);
        $timestamp_date2 = strtotime($date2);

        // it may be that second of one day is
        // greater than 86400, so use floor.
        // i.e. one second was added
        $days = floor(($timestamp_date2 - $timestamp_date1)/$secondOfOneDay) + 1;

        $lawdays = Lookup::itemsQuery(LawHoliday::tableName());

        foreach ($lawdays as $lawday) {
            $isInHoliday =
                self::compareDate($date1, $lawday)
                && self::compareDate($lawday, $date2);
            if ($isInHoliday) {
                $days--;
            }
        }

        return $days;
    }

    /**
     * calculate the number days between leave and cancel
     * removing law holiday.
     * @return integer number of days
     */
    public function getDaysHoliday()
    {
        return self::daysBetweenDates(
            $this->date_leave,
            $this->date_cancel
        );
    }

    /**
     * calculate the number days between leave and come
     * removing law holiday.
     * @return integer number of days
     */
    public function daysLeft()
    {
        return self::daysBetweenDates(
            date('Y-m-d'),
            $this->date_come
        );
    }

    /**
     * get date after date_bench date by num_day days,
     * and whether remove LawHoliday date in it.
     * @param date $date_bench bench date
     * @param integer $num_day number days
     * @return date
     */
    public static function dateAfterDateByDays($date_bench, $num_day)
    {
        if ($num_day <=0) {
            return $date_bench;
        }
        $num_real_day = $num_day - 1;
        while (self::daysBetweenDates(
            $date_bench,
            $result = date(
                'Y-m-d',
                strtotime(
                    $date_bench . ' '
                    . ($num_real_day++) . ' day'
                )
            )
        ) != $num_day) {
        }

        return $result;
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->date_latest = $this->latestComeDate;
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
    public static function cronYearDeleteOldHolidays()
    {
        return self::deleteAll([
            '<', 'date_leave',
            date('Y-m-d', strtotime('-10 years'))
        ]);
    }

    /**
     * search unreturn person who in holiday
     * and send messages about them to
     * Junwuke and Ganbuke.
     * @return the number of deleted
     */
    public static function cronDayNotifyUnreturnPersoninfo()
    {
        $date_bench = date('Y-m-d', strtotime(
            Yii::$app->setting->get('day_unreturn_notify') . ' day'
        ));
        $count = Holiday::find()
            ->where([
                '<=', 'date_come', $date_bench
            ])
            ->andWhere([
                'date_cancel' => null,
            ])
            ->andWhere([
                'in', 'id', (new Query)
                ->select('id')
                ->from(Personinfo::tableName())
                ->where(['<', 'mil_rank', MilRank::LOWESTMOFFICER])
            ])
            ->count();
        if ($count > 0) {
            $url = Html::a('这里', ['holiday/unreturn-notify']);
            $message = new Message;
            $message->content = "<p>当前有 $count 人临近归队。无需回复。</p><pre>详细信息请点 $url </pre>";
            $message->receiver = Yii::$app->setting->get('receiver_soldier');
            $message->sender = User::CONSOLE_CRON_USER;
            $message->status = Message::UNREAD;
            $message->save();
        }
    }
}
