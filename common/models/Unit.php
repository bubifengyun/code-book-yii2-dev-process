<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\Html;

class Unit extends \kartik\tree\models\Tree
{
    const WORK_OUT = 1;
    const WEEKEND_OUT = 1;
    const READYWAR_OUT = 2;
    const WORK_HOLIDAY = 4;
    const WEEKEND_HOLIDAY = 4;
    const READYWAR_HOLIDAY = 8;

    const TYPE_OUT = 'out';
    const TYPE_HOLIDAY = 'holiday';

    const BASE_JUNIOR = 0;
    const BASE_SENIOR = 1;
    const BASE_ROOT = 2;

    const DIFF = 5;

    const OFFICER = 0;
    const SOLDIER = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_limited', 'base_level', 'type'], 'safe'],
            [['duty_officer'], 'safe'],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%unit}}';
    }

    /**
     * check whether proportion is over.
     * @param float $proportion, 0-1 float number
     * @param integer $unit_code, unit id.
     * @param string $outOrHoliday, "out","holiday" are permitted.
     * @param boolen $isSoldier
     * @return boolen is it OverProportion as Out or Holiday
     */
    public static function isOverProportion($proportion, $unit_code, $outOrHoliday, $isSoldier)
    {
        $type = (new Query)->select('type')
            ->from(self::tableName())
            ->where(['id' => $unit_code])
            ->one();
        $task_mode = Yii::$app->setting->get('task_mode');
        $mode = 0;
        switch ($task_mode) {
            case Lookup::TASK_WORK :
                if ($outOrHoliday === self::TYPE_OUT) {
                    $mode = self::WORK_OUT;
                } elseif ($outOrHoliday === self::TYPE_HOLIDAY) {
                    $mode = self::WORK_HOLIDAY;
                }
            break;
            case Lookup::TASK_WEEKEND :
                if ($outOrHoliday === self::TYPE_OUT) {
                    $mode = self::WEEKEND_OUT;
                } elseif ($outOrHoliday === self::TYPE_HOLIDAY) {
                    $mode = self::WEEKEND_HOLIDAY;
                }
            break;
            case Lookup::TASK_READYWAR :
                if ($outOrHoliday === self::TYPE_OUT) {
                    $mode = self::READYWAR_OUT;
                } elseif ($outOrHoliday === self::TYPE_HOLIDAY) {
                    $mode = self::READYWAR_HOLIDAY;
                }
            break;
        }

        if (($type & $mode) === 0) {
            return false;
        } else {
            $proportion_id = $mode;
            if (!$isSoldier) {
                $proportion_id = $mode + self::DIFF;
            }
            $benchProportion = Lookup::proportion($proportion_id);
            if ($proportion > $benchProportion) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * see current task mode
     * if task_mode is work or weekend,
     * return [total, ratio, total_can_out, had_out, current_can_out]
     * if task_mode is readywar,
     * return the same, give different result.
     * @return array [total,ratio,.etc]
     */
    public function getCurrentCanOutInformation()
    {
        $officer_count = (new Query)
            ->select('id')
            ->from(Personinfo::tableName())
            ->where([
                'unit_code' => $this->id,
                'status' => [Status::HERE, Status::OUT],
            ])
            ->andWhere(['>=', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();
        $officer_hadout_count = (new Query)
            ->select('id')
            ->from(Personinfo::tableName())
            ->where([
                'unit_code' => $this->id,
                'status' => Status::OUT,
            ])
            ->andWhere(['>=', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();
        $soldier_count = (new Query)
            ->select('id')
            ->from(Personinfo::tableName())
            ->where([
                'unit_code' => $this->id,
                'status' => [Status::HERE, Status::OUT],
            ])
            ->andWhere(['<', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();
        $soldier_hadout_count = (new Query)
            ->select('id')
            ->from(Personinfo::tableName())
            ->where([
                'unit_code' => $this->id,
                'status' => Status::OUT,
            ])
            ->andWhere(['<', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();

        $ratio = $this->currentOutRatio;

        $officer_total_canout_count = floor($officer_count * $ratio[self::OFFICER] / 100);
        $soldier_total_canout_count = floor($soldier_count * $ratio[self::SOLDIER] / 100);

        $officer_current_canout_count = $officer_total_canout_count - $officer_hadout_count;
        $soldier_current_canout_count = $soldier_total_canout_count - $soldier_hadout_count;

        return [
            'officer' => [
                'total_canout_count' => $officer_total_canout_count,
                'hadout_count' => $officer_hadout_count,
                'current_canout_count' => $officer_current_canout_count,
                'ratio' => $ratio[self::OFFICER],
            ],
            'soldier' => [
                'total_canout_count' => $soldier_total_canout_count,
                'hadout_count' => $soldier_hadout_count,
                'current_canout_count' => $soldier_current_canout_count,
                'ratio' => $ratio[self::SOLDIER],
            ],
        ];
    }

    /**
     * return decide current task_mode and unit type.
     * @return array [officer-out-ratio, soldier-out-ratio]
     */
    public function getCurrentOutRatio()
    {
        $type = (new Query)->select('type')
            ->from(self::tableName())
            ->where(['id' => $this->id])
            ->one();
        $task_mode = Yii::$app->setting->get('task_mode');
        $mode = 0;
        switch ($task_mode) {
            case Lookup::TASK_WORK :
                $mode = self::WORK_OUT;
            break;
            case Lookup::TASK_WEEKEND :
                $mode = self::WEEKEND_OUT;
            break;
            case Lookup::TASK_READYWAR :
                $mode = self::READYWAR_OUT;
            break;
        }

        if (($type & $mode) === 0) {
            return [
                self::OFFICER => 100,
                self::SOLDIER => 100,
            ];
        } else {
            $soldier_proportion_id = $mode;
            $officer_proportion_id = $mode + self::DIFF;
            $soldier_proportion = Lookup::proportion($soldier_proportion_id);
            $officer_proportion = Lookup::proportion($officer_proportion_id);

            return [
                self::OFFICER => $officer_proportion,
                self::SOLDIER => $soldier_proportion,
            ];
        }
    }

    /**
     * change getCurrentCanOutInformation to string
     * @return string getCurrentCanOutInformation's
     */
    public function getInfoAsString()
    {
        return '';
    }

    /**
     * get current person complete holiday number
     * @return integer count of current complete holiday
     */
    public function getCurrentCountSeniorSoldierCompleteHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }
        $mil_rank_seniorsoldier = range(MilRank::LOWESTSSOLDIER, MilRank::LOWESTMOFFICER -1);

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
                'mil_rank' => $mil_rank_seniorsoldier,
            ])
            ->andWhere([
                'in', 'id',
                (new Query)
                ->select('id')
                ->from(StatisticsHoliday::tableName())
                ->where([
                    '<', 'day_left',
                    Yii::$app->setting->get('day_soldier_min_holiday'),
                ])
            ])
            ->count();
    }

    /**
     * get current person complete holiday number
     * @return integer count of current complete holiday
     */
    public function getCurrentCountOfficerCompleteHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
            ])
            ->andWhere(['>', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->andWhere([
                'in', 'id',
                (new Query)
                ->select('id')
                ->from(StatisticsHoliday::tableName())
                ->where([
                    'day_left' => 0,
                ])
            ])
            ->count();
    }

    /**
     * get current person in holiday number
     * @return integer count of current in holiday
     */
    public function getCurrentCountSeniorSoldierInHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }
        $status_inholiday = [Status::OVERLEAVE +1, Status::OVERLEAVE +2];
        $mil_rank_seniorsoldier = range(MilRank::LOWESTSSOLDIER, MilRank::LOWESTMOFFICER -1);

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
                'status' => $status_inholiday,
                'mil_rank' => $mil_rank_seniorsoldier,
            ])
            ->count();
    }

    /**
     * get current person in holiday number
     * @return integer count of current in holiday
     */
    public function getCurrentCountOfficerInHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }
        $status_inholiday = [Status::OVERLEAVE +1, Status::OVERLEAVE +2];

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
                'status' => $status_inholiday,
            ])
            ->andWhere(['>', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();
    }

    /**
     * get current person in holiday number
     * @return integer count of current in holiday
     */
    public function getCurrentSeniorSoldierInHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }
        $status_inholiday = [Status::OVERLEAVE +1, Status::OVERLEAVE +2];
        $mil_rank_seniorsoldier = range(MilRank::LOWESTSSOLDIER, MilRank::LOWESTMOFFICER -1);

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
                'status' => $status_inholiday,
                'mil_rank' => $mil_rank_seniorsoldier,
            ])
            ->all();
    }

    /**
     * get current person in holiday number
     * @return integer count of current in holiday
     */
    public function getCurrentOfficerInHoliday()
    {
        $children = $this->children()->all();
        $selfAndChildrenID = [$this->id];
        foreach ($children as $child) {
            $selfAndChildrenID[] = $child->id;
        }
        $status_inholiday = [Status::OVERLEAVE +1, Status::OVERLEAVE +2];

        return Personinfo::find()
            ->where([
                'unit_code' => $selfAndChildrenID,
                'status' => $status_inholiday,
            ])
            ->andWhere(['>', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->all();
    }

    public static function personNamesToHtml($personinfos)
    {
        $result = '';
        $i = 1;
        $max_column = 5;
        foreach ($personinfos as $personinfo) {
            if ($i > $max_column) {
                $i = 1;
                $result .= '<br>';
            }
            $result .=
                Html::a(
                    $personinfo->name,
                    ['personinfo/view',
                    'id' => $personinfo->id]
                ) . '；';
            $i++;
        }
        return $result;
    }

    /**
     * when something go wrong, you can recheck
     * this data
     */
    public static function refreshCountsAll()
    {
        $units = self::find()
            ->where(1)
            ->all();

        foreach ($units as $unit) {
            $unit->refreshCounts();
        }
    }

    public function refreshCounts()
    {
        $children = $this->children()->all();
        $id = [$this->id];
        foreach ($children as $child) {
            $id[] = $child->id;
        }
        $this->count_total = Personinfo::find()
            ->where(['unit_code' => $id])
            ->count();
        $this->count_officer = Personinfo::find()
            ->where(['unit_code' => $id])
            ->andWhere([
                '>=', 'mil_rank', MilRank::LOWESTMOFFICER
            ])
            ->count();
        $this->count_soldier = Personinfo::find()
            ->where(['unit_code' => $id])
            ->andWhere([
                '<', 'mil_rank', MilRank::LOWESTMOFFICER
            ])
            ->count();
        $this->count_senior_soldier = Personinfo::find()
            ->where(['unit_code' => $id])
            ->andWhere([
                '<', 'mil_rank', MilRank::LOWESTMOFFICER
            ])
            ->andWhere([
                '>=', 'mil_rank', MilRank::LOWESTSSOLDIER
            ])
            ->count();

        $this->save();
    }

    /**
     * get the direct parent
     * @return Unit
     */
    public function getUpParent()
    {
        return $this->parents(1)->one();
    }

    /**
     * get self and children ids
     * @return array self and children's id
     */
    public function getSelfAndChildrenIds()
    {
        $children = $this->children()->all();
        $id = [$this->id];
        foreach ($children as $child) {
            $id[] = $child->id;
        }
        return $id;
    }

    /**
     * get one unit and its children ids
     * @return array its children and its id
     */
    public static function itsAndChildrenIds($unit_code)
    {
        return self::findOne($unit_code)->selfAndChildrenIds;
    }

    /**
     * Get current status information
     * of this unit.
     * The result will be an array, whose
     * key will be number standing for
     * status id, whose
     * value will
     * be array = ['count','personinfo'].
     * And where key is string with its mean,
     * the value will be its count.
     * @return array special formation
     */
    public function getCurrentInformation()
    {
        $result = [];
        $children = $this->children()->all();
        $id = [$this->id];
        foreach ($children as $child) {
            $id[] = $child->id;
        }

        $queryPersoninfo = function ($array_sql1 = [], $array_sql2 = []) use ($id) {

            return Personinfo::find()
                ->where(['unit_code' => $id])
                ->andWhere($array_sql1)
                ->andWhere($array_sql2)
                ->orderBy('mil_rank DESC, id ASC');
        };

        foreach (Lookup::itemsQuery(Status::tableName()) as $status_id => $status_name) {
            $total_status_one =
                $queryPersoninfo([
                    'status' => $status_id,
                ])->count();
            $military_officers_status_one =
                $queryPersoninfo(
                    ['status' => $status_id],
                    ['>=', 'mil_rank', MilRank::LOWESTMOFFICER]
                );
            $count_military_officers_status_one = $military_officers_status_one->count();
            $soldiers_status_one =
                $queryPersoninfo(
                    ['status' => $status_id],
                    ['<', 'mil_rank', MilRank::LOWESTMOFFICER]
                );
            $count_soldiers_status_one = $soldiers_status_one->count();
            $result[$status_id] = [
                'total' => $total_status_one,
                'officer' => [
                    'count' => $count_military_officers_status_one,
                    'query' => $military_officers_status_one,
                ],
                'soldier' => [
                    'count' => $count_soldiers_status_one,
                    'query' => $soldiers_status_one,
                ],
            ];
        }

        $result['total'] = $this->count_total;
        $result['count_officer'] = $this->count_officer;
        $result['count_soldier'] = $this->count_soldier;

        $status_id_string = Yii::$app->setting->get('status_here');
        $status_ids = explode(
            ':',
            $status_id_string
        );

        $result['count_here_soldier'] = 0;
        foreach ($status_ids as $status_id) {
            $result['count_here_soldier'] +=
                $result[$status_id]['soldier']['count'];
        }
        $result['count_here_officer'] = 0;
        foreach ($status_ids as $status_id) {
            $result['count_here_officer'] +=
                $result[$status_id]['officer']['count'];
        }

        $status_id_string = Yii::$app->setting->get('status_current_here');
        $status_ids = explode(
            ':',
            $status_id_string
        );

        $result['count_current_here_soldier'] = 0;
        foreach ($status_ids as $status_id) {
            $result['count_current_here_soldier'] +=
                $result[$status_id]['soldier']['count'];
        }
        $result['count_current_here_officer'] = 0;
        foreach ($status_ids as $status_id) {
            $result['count_current_here_officer'] +=
                $result[$status_id]['officer']['count'];
        }


        if ($result['count_officer'] == 0) {
            $result['ratio_officer'] = 0;
        } else {
            $result['ratio_officer'] =
                $result['count_here_officer'] * 100
                / $result['count_officer'];
            $result['ratio_officer'] =
                ceil($result['ratio_officer']);
        }

        if ($result['count_soldier'] == 0) {
            $result['ratio_soldier'] = 0;
        } else {
            $result['ratio_soldier'] =
                $result['count_here_soldier'] * 100
                / $result['count_soldier'];
            $result['ratio_soldier'] =
                ceil($result['ratio_soldier']);
        }

        $result['count_here'] =
            $result['count_here_officer'] +
            $result['count_here_soldier'];

        $result['count_unhere'] =
            $result['total'] -
            $result['count_here'];

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'icon' => '图标',
            'icon_type' => '图标类型',
            'name' => '单位',
            'count_senior_soldier' => '士象总人数',
            'count_officer' => '车马炮总人数',
            'currentCountSeniorSoldierInHoliday' => '正在探亲休假人数',
            'currentCountOfficerInHoliday' => '正在探亲休假人数',
            'currentCountSeniorSoldierCompleteHoliday' => '累计完成人数',
            'currentCountOfficerCompleteHoliday' => '累计完成人数',
            'is_limited' => '是否某某某限制',
            'base_level' => '单位级别',
            'type' => '限制类型',
            'duty_officer' => '值班老板(姓名)',
        ];
    }

    /**
     * this is nothing at all
     */
    public static function saveFromExcel($data)
    {
        //nothing done!
        return 0;
    }
}
