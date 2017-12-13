<?php

namespace console\controllers;

use Yii;
use yii\helpers\Console;
use common\models\Lookup;
use common\models\ReadyWar;
use common\models\Weekend;
use common\models\Personinfo;
use common\models\StatisticsHoliday;
use common\models\LawHoliday;
use common\models\Holiday;
use common\models\Outs;
use common\models\Gate;
use common\models\Message;
use common\models\PublicFunction;

class CrontabController extends \yii\console\Controller
{
    public function actionIndex()
    {
        exec("echo `date` > /tmp/who");
        $this->stdout("帮助：\n", Console::BOLD);
        $code_hour = $this->ansiFormat('yii crontab/hour-cron', Console::FG_RED);
        $code_week = $this->ansiFormat('yii crontab/week-cron', Console::FG_RED);
        $code_year = $this->ansiFormat('yii crontab/year-cron', Console::FG_RED);
        $help = <<<TEXT
有若干种定期执行命令。
一种是每个小时执行一次的命令。
如下执行
$code_hour
一种是每周执行一次的命令。
如下执行
$code_week
一种是每年执行一次的命令
如下执行
$code_year

TEXT;
        echo $help;
        return 0;
    }

    /**
     * 检测到周末时间，且是工作日，则改为周末休息
     * 检测到不在周末时间，且是周末休息，则改为工作日
     * 还需要修改一些人的在位状态.
     * 每小时的01分钟开始运行。
     */
    public function actionHourWeekendModeCron()
    {
        $begin_timestamp = Weekend::getBeginTimestamp();
        $end_timestamp = Weekend::getEndTimestamp();
        $now_timestamp = time();
        $isWeekend = ($now_timestamp >= $begin_timestamp
            && $now_timestamp <= $end_timestamp);
        if ($isWeekend) {
            if (Yii::$app->setting->get('task_mode') == Lookup::TASK_WORK) {
                Yii::$app->setting->set(['task_mode' => Lookup::TASK_WEEKEND]);
                Personinfo::setLeaveForHomers();
            }
        } else {
            if (Yii::$app->setting->get('task_mode') == Lookup::TASK_WEEKEND) {
                Yii::$app->setting->set(['task_mode' => Lookup::TASK_WORK]);
                Personinfo::setReturnForHomers();
            }
        }
        return 0;
    }

    public function actionStartWeekendCron()
    {
        if (Yii::$app->setting->get('task_mode') == Lookup::TASK_WORK) {
            Yii::$app->setting->set(['task_mode' => Lookup::TASK_WEEKEND]);
        }
    }

    public function actionStopWeekendCron()
    {
        if (Yii::$app->setting->get('task_mode') == Lookup::TASK_WEEKEND) {
            Yii::$app->setting->set(['task_mode' => Lookup::TASK_WORK]);
        }
        Weekend::defaultRun();
    }

    public function actionStartReadyWarCron()
    {
        Yii::$app->setting->set(['task_mode' => Lookup::TASK_READYWAR]);
    }

    public function actionStopReadyWarCron()
    {
        Yii::$app->setting->set(['task_mode' => Lookup::TASK_WORK]);
    }

    /**
     * 检测到战备开始日，则设置工作状态为战备。
     * 检测到战备结束日，则设置工作状态为工作。
     * 战备结束日会滞后一天修改战备状态。
     * run in 00:10:00 every day.
     * 每天凌晨0点十分开始运行。
     */
    public function actionDayReadyWarCron()
    {
        $begin_date = ReadyWar::getBeginDate();
        $end_date = ReadyWar::getEndDate();
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $hasBegun = (strcmp($begin_date, $today) === 0);
        $hasEnd = (strcmp($end_date, $yesterday) === 0);
        if ($hasBegun) {
            Yii::$app->setting->set(['task_mode' => Lookup::TASK_READYWAR]);
        } elseif ($hasEnd) {
            Yii::$app->setting->set(['task_mode' => Lookup::TASK_WORK]);
        }
        return 0;
    }

    /**
     * 每天查询还有若干天就要归队的人员名单
     * run in 00:20:00 every day.
     */
    public function actionDayUnreturnNotifyCron()
    {
        Holiday::cronDayNotifyUnreturnPersoninfo();
        return 0;
    }

    public function actionReadBackupCron($frequency = 'hour')
    {
        return PublicFunction::readBackup($frequency);
    }

    public function actionDayCron(array $name)
    {
        exec("echo `date` > /tmp/daycron.py");
        return 0;
    }

    public function actionWeekSetWeekendCron()
    {
        echo "This is will run every hour\n";
        return 0;
    }

    /**
     * XXXX-09/10/11/12-01 01:00 run
     */
    public function actionYearNotifyAddLawHolidayCron()
    {
        $hasSet = LawHoliday::hasSetNextYearLawHoliday();
        if (!$hasSet) {
            LawHoliday::sendNotify();
            return 1;
        }
        return 0;
    }

    /**
     * XXXX-01-01 01:00 run
     */
    public function actionYearDeleteAndSetCron()
    {
        StatisticsHoliday::cronYearResetForNewYear();
        Outs::cronYearDeleteOldRecords();
        Gate::cronYearDeleteOldTraffic();
        Holiday::cronYearDeleteOldHolidays();
        LawHoliday::cronYearDeleteOldLawHolidays();
        Message::cronYearDeleteOldMessages();
        Message::cronYearHappyNewYear();
        return 0;
    }
}
