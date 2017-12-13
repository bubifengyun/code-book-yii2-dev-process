<?php

namespace common\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\db\Query;
use yii\db\Expression;

/**
 * This is the model class for table "{{%statistics_holiday}}".
 *
 * @property string $id
 * @property integer $day_total
 * @property integer $day_left_lastyear
 * @property integer $day_lend_nextyear
 * @property integer $day_left
 * @property string $day_lend_nextyear_ps
 * @property integer $day_tohere
 * @property string $boss_id
 * @property integer $current_h_id
 * @property string $tel
 * @property integer $day_add
 * @property integer $day_add_is_nextyear
 * @property string $day_add_ps
 * @property integer $day_path
 */
class StatisticsHoliday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statistics_holiday}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['day_total', 'day_left', 'day_left_lastyear', 'day_lend_nextyear', 'day_tohere', 'current_h_id', 'day_add', 'day_add_is_nextyear', 'day_path'], 'integer'],
            [['id', 'day_lend_nextyear_ps', 'boss_id', 'tel'], 'string', 'max' => 32],
            [['day_add_ps'], 'string', 'max' => 256],
            [['type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '本人身份证',
            'day_total' => '假期总天数',
            'day_left' => '剩余天数',
            'type' => '假期类型',
            'day_standard' => '休假标准',
            'day_left_lastyear' => '去年剩余假期',
            'day_lend_nextyear' => '明年转借假期',
            'day_lend_nextyear_ps' => '借假备注',
            'day_tohere' => '还有几天到这里',
            'boss_id' => '负责人',
            'current_h_id' => '当前假表',
            'tel' => '电话',
            'day_add' => '假期增减天数',
            'day_add_is_nextyear' => '假期增减在明年',
            'day_add_ps' => '假期增减说明',
            'day_path' => '路途',
        ];
    }

    /**
     * set current holiday h_id
     * @param $id holiday h_id
     * @return boolen
     */
    public function setCurrentHoliday($h_id)
    {
        $this->current_h_id = $h_id;
        return $this->save();
    }

    /**
     * init defaults every year
     * need test.
     * if save success return true, else false.
     * @return boolen
     */
    public static function cronYearSetHolidayForMarried()
    {

    }

    /**
     * reset statisticsholiday every new year
     */
    public static function cronYearResetForNewYear()
    {
        self::updateAll(
            [
                'day_add' => new Expression(
                    '- day_lend_nextyear'
                ),
                'day_add_ps' => new Expression(
                    'concat(:pro,day_lend_nextyear_ps,:suf)',
                    [
                        ':pro' => date('Y(', strtotime('-1 year')),
                        ':suf' => ')',
                    ]
                ),
                'type' => null,
                'day_total' => 0,
                'day_left' => 0,
                'day_standard' => 0,
                'day_lend_nextyear' => 0,
                'day_lend_nextyear_ps' => null,
            ],
            [
                'in', 'id',
                (new Query())
                ->select('id')
                ->from(Personinfo::tableName())
                ->where([
                    '>=', 'mil_rank',
                    MilRank::LOWESTSSOLDIER
                ])
            ]
        );
    }

    /**
     * Just load, without save.
     * @param array $type array of status identify
     * @return boolean load successfully?
     */
    public function loadType($type)
    {
        if ($type == null or $type =='') {
            return;
        }
        if (!is_array($type)) {
            if (!is_numeric($type)) {
                return false;
            } else {
                $type = [$type];
            }
        }

        $isFirst = false;
        if ($this->type == '' or $this->type == null) {
            $isFirst = true;
        }
        foreach ($type as $_t) {
            if (!is_numeric($_t)) {
                return false;
            }
            if ($isFirst) {
                $this->type = $_t;
                $isFirst = false;
            } else {
                $this->type .= ":" . $_t;
            }
        }

        return true;
    }

    /**
     * init defaults every year
     * need test.
     * if save success return true, else false.
     * @return boolen
     */
    public static function cronYearSetHolidayForUnmarried()
    {
        $age_later_oneyear = Yii::$app->setting->get('age_older_unmarried') - 1;
        $benchdate = date("Y-m-d", strtotime("-$age_later_oneyear year"));

        // for younger than 28 years officer
        self::updateAll(
            ['day_total' => new Expression(
                'day_path + day_add + :day_holiday',
                [':day_holiday' => Yii::$app->setting->get('day_holiday')]
            )],
            [
                'in', 'id',
                (new Query())
                ->select('id')
                ->from('{{%personinfo}}')
                ->where([
                    '>=', 'birthdate',
                    $benchdate
                ])
                ->andWhere([
                    'is_married' => '否'
                ])
                ->andWhere([
                    '>=', 'mil_rank',
                    MilRank::LOWESTMOFFICER
                ])
            ]
        );

        // for elder >=28 years officer
        self::updateAll(
            ['day_total' => new Expression(
                'day_path + day_add + :day_holiday + :day_older_unmarried',
                [
                    ':day_holiday' => Yii::$app->setting->get('day_holiday'),
                    ':day_older_unmarried' => Yii::$app->setting->get('day_older_unmarried')
                ]
            )],
            [
                'in', 'id',
                (new Query())
                ->select('id')
                ->from('{{%personinfo}}')
                ->where([
                    '<', 'birthdate',
                    $benchdate
                ])
                ->andWhere([
                    'is_married' => '否'
                ])
                ->andWhere([
                    '>=', 'mil_rank',
                    MilRank::LOWESTMOFFICER
                ])
            ]
        );
        return true;
    }

    /**
     * init defaults every year
     * need test.
     * if save success return true, else false.
     * @return boolen
     */
    public function initYearDefaults()
    {
        $this->save();
        return;
        // we assume that
        if ($this->day_path === 0) {
            $this->day_path = $this->owner->parentshome_district->day_path;
        }

        if ($this->owner->can_home_weekend) {
            $this->day_path = 0;
            $this->day_total = Yii::$app->setting->get('day_home_weekend');
        } elseif (!$this->owner->is_married) {
            $this->day_total = Yii::$app->setting->get('day_holiday');
            if ($this->owner->isOlderUnmarried) {
                $this->day_total += Yii::$app->setting->get('day_older_unmarried');
            }
        } elseif ($this->owner->is_married) {
            $this->day_total = Yii::$app->setting->get('day_married');
        }

        $this->day_total += $this->day_path;
        $this->day_left = $this->day_total;

        return $this->save();
    }

    /**
     * if current holiday completed,
     * it will do something later.
     * @param $currentHoliday Holiday model
     * @return boolen wheather save successful
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function completeHoliday($currentHoliday)
    {
        if ($currentHoliday->isOverleave) {
            $this->owner->setStatus(Status::OVERLEAVE);
            throw new MethodNotAllowedHttpException('你已超假！应归队日期:' .
            $currentHoliday->date_latest);
        }

        if (Status::isOccupy($currentHoliday->kind)) {
            if ($currentHoliday->isLastyearWhenleave) {
                $this->day_left_lastyear -= $currentHoliday->daysHoliday;
            } else {
                $this->day_left -= $currentHoliday->daysHoliday;
            }
        }
        $this->current_h_id = null;
        return $this->save();
    }

    /**
     * if cannot find throw Exception
     * @return Holiday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getTypename()
    {
        if ($this->type == null) {
            return '';
        }

        $types = explode(':', $this->type);
        $result = '';
        $count = count($types);
        $i=0;
        foreach ($types as $type) {
            $result .= Lookup::itemQuery(Status::tableName(), $type);
            $i++;
            if ($i != $count) {
                $result .= '+';
            }
        }
        return $result;
    }

    /**
     * change type to array
     * in order to use checkboxlist
     */
    public function getTypearray()
    {
        if ($this->type == '' or $this->type == null) {
            return [];
        }

        return explode(':', $this->type);
    }

    /**
     * change array type to string
     */
    public function recoverType()
    {
        $types = $this->type;
        $this->type = '';
        $this->loadType($types);
    }

    /**
     * if cannot find throw Exception
     * @return Holiday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getCurrentHoliday()
    {
        $holiday = $this->hasOne(Holiday::className(), ['h_id' => 'current_h_id']);

        if ($holiday === null) {
            throw new NotFoundHttpException('没有找到你的待销假的休假单。');
        }

        return $holiday;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Personinfo::className(), ['id' => 'id']);
    }

    /**
     * check day_left for everyone
     */
    public static function cronDayCheckHoliday()
    {
        $all = self::find()->where(1)->all();

        $transaction = Yii::$app->db->beginTransaction();
        foreach ($all as $sh) {
            $holidays = Holiday::findAll([
                'id' => $sh->id,
                'which_year' => date('Y'),
            ]);

            $day_cost = 0;
            foreach ($holidays as $holiday) {
                if (Status::isOccupy($holiday->kind)) {
                    $day_cost += $holiday->daysHoliday;
                }
            }

            $sh->day_left -= $day_cost;
            $sh->save();
        }
        $transaction->commit();
    }
}
