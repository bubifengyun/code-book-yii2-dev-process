<?php

namespace common\models;

use Yii;
use yii2tech\crontab\CronTab;

/**
 * This is the model class for table "{{%cronjob}}".
 *
 * @property string $id
 * @property string $line
 */
class Cronjob extends \yii\db\ActiveRecord
{
    const READYWAR_BEGIN = 'ready-war-begin';
    const READYWAR_END = 'ready-war-end';
    const WEEKEND_BEGIN = 'weekend-begin';
    const WEEKEND_END = 'weekend-end';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cronjob}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'line'], 'required'],
            [['id'], 'string', 'max' => 32],
            [['line'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'line' => '命令',
        ];
    }

    /**
     * @param $line string command
     * @return boolen
     */
    public static function saveToSQL($line)
    {
        $model = new Cronjob();
        $model->id = md5($line);
        $model->line = $line;
        $model->save();
        return $model->id;
    }

    public static function isReLine($line)
    {
        $count = self::find()
            ->where(['line' => $line])
            ->count();
        return $count > 0;
    }

    public static function getIdFromLine($line)
    {
        $model = self::findOne()
            ->where(['line' => $line]);
        if ($model!==null) {
            return $model->id;
        }
        return false;
        
    }

    public static function getAllLines()
    {
        return self::find()
            ->select('line')
            ->where(1)
            ->asArray()
            ->all();
    }

    /**
     * When weekend is set, do as readme.
     *
     * @param Weekend $weekend Weekend identify
     *
     * @return null
     */
    public static function dealWeekend($weekend)
    {
        self::setCronjob(
            self::WEEKEND_BEGIN,
            $weekend->begin_date,
            '/opt/lampp/htdocs/www/wuzhishan/yii'
                . ' crontab/start-weekend-cron'
        );

        self::setCronjob(
            self::WEEKEND_END,
            $weekend->end_date,
            '/opt/lampp/htdocs/www/wuzhishan/yii'
                . ' crontab/stop-weekend-cron'
        );
    }

    public static function dealReadyWar($readywar)
    {
        self::setCronjob(
            self::READYWAR_BEGIN,
            $readywar->begin_date,
            '/opt/lampp/htdocs/www/wuzhishan/yii'
                . ' crontab/start-ready-war-cron'
        );
        self::setCronjob(
            self::READYWAR_END,
            $readywar->end_date,
            '/opt/lampp/htdocs/www/wuzhishan/yii'
                . ' crontab/stop-ready-war-cron'
        );
    }

    private static function setCronjob($id, $date, $cmd)
    {
        $model = self::findOne($id);
        if ($model === null) {
            $model = new Cronjob;
            $model->id = $id;
        }

        $model->line = self::dateTime2cron($date) . $cmd;
        $model->save();
        self::refreshCronjob();
    }

    private static function dateTime2cron($date)
    {
        $_min = date('i', strtotime($date));
        $_hour = date('H', strtotime($date));
        $_date = date('d', strtotime($date));
        $_month = date('m', strtotime($date));

        return $_min . ' ' .
            $_hour . ' ' .
            $_date . ' ' .
            $_month . ' ' .
            '*' . ' ';
    }

    public static function refreshCronjob()
    {
        $lines = self::getAllLines();
        $cronTab = new CronTab();
        $cronTab->removeAll();
        $cronTab->headLines = [
            '# this crontab created by 人员在位管理系统',
            'SHELL=/bin/bash',
            'PATH=/usr/local/bin:/bin:/usr/bin',
        ];
        $cronTab->setJobs($lines);
        $cronTab->apply();
    }

    /**
     * This is invoked after the record is saved.
     */
    /*
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        $lines = self::getAllLines();
        $head_lines = [
            'SHELL=/bin/bash',
            'PATH=/usr/local/bin:/bin:/usr/bin',
        ];
        $cronTab = new \yii2tech\crontab\CronTab();
        $cronTab->removeAll();
        $cronTab->applyLines($head_lines);
        $cronTab->setJobs($lines);
        $cronTab->apply();
    }
     */
}
