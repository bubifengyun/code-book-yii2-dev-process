<?php

namespace common\models;

use Yii;
use Overtrue\Pinyin\Pinyin;
use yii\base\InvalidParamException;
use yii\db\Query;

/**
 * This is the model class for table "{{%personinfo}}".
 *
 * @property string $id
 * @property string $name
 * @property string $namepinyin
 * @property string $sex
 * @property string $is_married
 * @property string $spouse_type
 * @property string $property
 * @property string $photo
 * @property string $can_home_weekend
 * @property string $birthdate
 * @property string $armydate
 * @property string $current_mil_rank_date
 * @property string $next_mil_rank_date
 * @property string $current_techgrade_date
 * @property string $next_techgrade_date
 * @property string $current_other_date
 * @property string $next_other_date
 * @property integer $status
 * @property integer $mil_rank
 * @property integer $unit_code
 * @property string $tech_grade
 * @property string $job
 * @property string $tel
 * @property integer $myhome_province
 * @property integer $myhome_city
 * @property integer $myhome_district
 * @property integer $parentshome_province
 * @property integer $parentshome_city
 * @property integer $parentshome_district
 * @property string $hometown
 * @property string $qrcode
 * @property string $minzu
 * @property string $education
 * @property string $armyaddress
 * @property string $type_date
 * @property string $current_job_date
 * @property string $home_address
 * @property string $ps
 */
class Personinfo extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%personinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'sex', 'is_married', 'can_home_weekend', 'birthdate', 'armydate', 'mil_rank', 'unit_code', 'job'], 'required'],
            [['sex', 'is_married', 'property', 'can_home_weekend'], 'string'],
            [['birthdate', 'armydate', 'current_mil_rank_date', 'next_mil_rank_date', 'current_techgrade_date', 'next_techgrade_date', 'current_other_date', 'next_other_date', 'type_date', 'current_job_date'], 'safe'],
            [['status', 'mil_rank', 'unit_code', 'myhome_province', 'myhome_city', 'myhome_district', 'parentshome_province', 'parentshome_city', 'parentshome_district'], 'integer'],
            [['id', 'tech_grade', 'job', 'tel', 'armyaddress'], 'string', 'max' => 32],
            [['name', 'photo'], 'string', 'max' => 64],
            [['namepinyin', 'home_address', 'ps'], 'string', 'max' => 128],
            [['spouse_type', 'minzu'], 'string', 'max' => 24],
            [['hometown'], 'string', 'max' => 56],
            [['qrcode'], 'string', 'max' => 256],
            [['education'], 'string', 'max' => 18],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '身份证',
            'name' => '姓名',
            'namepinyin' => '姓名拼音',
            'sex' => '性别',
            'is_married' => '婚否',
            'spouse_type' => '配偶跟随情况',
            'property' => '党团情况',
            'photo' => '照片',
            'can_home_weekend' => '周末回家',
            'birthdate' => '出生日期',
            'armydate' => '注册日期',
            'current_mil_rank_date' => '当前战斗级别日期',
            'next_mil_rank_date' => '下次战斗晋级日期',
            'current_techgrade_date' => '当前技术级别日期',
            'next_techgrade_date' => '下次技术晋级日期',
            'current_other_date' => '当前其他日期',
            'next_other_date' => '下次更改日期',
            'status' => '在位状态',
            'mil_rank' => '战斗级别',
            'unit_code' => '部别',
            'unitName' => '单位',
            'tech_grade' => '技术等级',
            'job' => '职务',
            'tel' => '电话',
            'myhome' => '配偶住址',
            'myhome_province' => '配偶住址（省级）',
            'myhome_city' => '配偶住址（市级）',
            'myhome_district' => '配偶住址（县级）',
            'parentshome' => '父母住址',
            'parentshome_province' => '父母住址（省级）',
            'parentshome_city' => '父母住址（市级）',
            'parentshome_district' => '父母住址（县级）',
            'hometown' => '籍贯',
            'qrcode' => '二维码',
            'minzu' => '民族',
            'education' => '文化程度',
            'armyaddress' => '游戏地点',
            'type_date' => '党团时间',
            'current_job_date' => '现职日期',
            'home_address' => '家庭通信地址',
            'ps' => '备注',
        ];
    }

    /**
     * 假设如果读取多个sheet，$excel_array结构如下
     * $excel_array[i][n]=['id'=>xx,'name'=>xx,...,]
     *
     * @param array $excel_array excel array
     *
     * @return mixed boolean true for success, or return error messages.
     */
    public static function saveFromExcelSheets($excel_array)
    {
        foreach ($excel_array as $raw) {
            if (isset($raw['姓名'])) {
                return self::saveFromExcelSheet($excel_array);
            }
        }

        $errors = [];
        foreach ($excel_array as $key => $raw) {
            $error = self::saveFromExcelSheet($raw);
            if ($error !== true) {
                $errors[$key] = $error;
            }
        }

        return $errors === [] ? true : $errors;
    }

    /**
     * 读取 csv 文件，并报错
     *
     */
    public static function saveFromCSV($filename)
    {
        $file = fopen($filename, "r");

        $count = 0;
        $data = [];
        $keys = [];
        $_tmp_data = [];
        while (($_data = fgetcsv($file, null, "\t")) !== false) {
            $count++;
            if ($count == 1) {
                $keys = $_data;
            } else {
                foreach ($_data as $key => $value) {
                    $_tmp_data[$keys[$key]] = $value;
                }
                $data[] = $_tmp_data;
            }
        }

        return self::saveFromExcelSheet($data);
    }

    /**
     * 读取 csv 文件，并报错
     *
     */
    public static function saveSoldierFromCSV($filename)
    {
        $file = fopen($filename, "r");

        $count = 0;
        $data = [];
        $keys = [];
        $_tmp_data = [];
        while (($_data = fgetcsv($file, null, "\t")) !== false) {
            $count++;
            if ($count == 1) {
                $keys = $_data;
            } else {
                foreach ($_data as $key => $value) {
                    $_tmp_data[$keys[$key]] = $value;
                }
                $data[] = $_tmp_data;
            }
        }

        return self::saveFromExcelSheet($data);
    }

    /**
     * 假设只读取一个sheet，$excel_array结构如下
     * $excel_array[i]=['id'=>xx,'name'=>xx,...,]
     *
     * @param array $excel_array excel array
     *
     * @return mixed true for success, or return error messages.
     */
    public static function saveFromExcelSheet($excel_array)
    {
        $model = new Personinfo;
        $transaction = Yii::$app->db->beginTransaction();
        $errors=[];
        $namepinyins=[];
        $overtrue_pinyin = new Pinyin();
        try {
            foreach ($excel_array as $raw) {
                if (!isset($raw['姓名']) || $raw['姓名'] === '' || $raw['姓名'] === null) {
                    break;
                }

                if (empty($raw['姓名拼音'])) {
                    $raw['姓名拼音'] = implode('', $overtrue_pinyin->name($raw['姓名']));
                }
                // 避免重复姓名拼音，加数字以示区别
                $pinyin=$raw['姓名拼音'];
                if (in_array($pinyin, $namepinyins)) {
                    $raw['姓名拼音'].=count(array_keys($namepinyins, $pinyin));
                }
                $namepinyins[]=$pinyin;

                $attribute = self::raw2attribute($raw);
                $model->isNewRecord = true;
                $model->setAttributes($attribute);
                if (!$model->save()) {
                    $errors[$raw['姓名']]=$model->getErrors();
                }
            }
            if ($errors===[]) {
                $transaction->commit();
                return true;
            } else {
                throw new InvalidParamException();
            }
        } catch (InvalidParamException $e) {
            $transaction->rollback();
            return $errors;
        }
    }

    /**
     * When load from excel, the data is not enough, We must complete it.
     *
     * @param array $raw original data
     *
     * @return array
     */
    public static function raw2attribute($raw)
    {
        $model = new Personinfo;
        $flip_attr = array_flip($model->attributeLabels());
        $attribute = [];
        foreach ($raw as $key => $value) {
            $attribute[$flip_attr[$key]] = $value;
        }
        $attribute['mil_rank'] = Lookup::id(MilRank::tableName(), $raw['战斗级别']);
        $attribute['unit_code'] = Lookup::id(Unit::tableName(), $raw['部别']);
        $attribute['id'] = $raw['姓名拼音'] .'.'. $attribute['unit_code']
            .'.'. date('Ym', strtotime($attribute['birthdate']))
            . '@' . Yii::$app->setting->get('email.hostname');

        $myhome = self::getPCDidFromNames($raw['配偶住址（省级）'], $raw['配偶住址（市级）'], $raw['配偶住址（县级）']);
        if ($myhome !== false) {
            $attribute['myhome_province'] = $myhome['pid'];
            $attribute['myhome_city'] = $myhome['cid'];
            $attribute['myhome_district'] = $myhome['did'];
        }

        $parentshome = self::getPCDidFromNames($raw['父母住址（省级）'], $raw['父母住址（市级）'], $raw['父母住址（县级）']);
        if ($parentshome !== false) {
            $attribute['parentshome_province'] = $parentshome['pid'];
            $attribute['parentshome_city'] = $parentshome['cid'];
            $attribute['parentshome_district'] = $parentshome['did'];
        }

        return $attribute;
    }

    /**
     * get pid,cid,did from pName,cName,dName
     * @param string $pName Provinces name
     * @param string $cName Cities name
     * @param string $dName Districts name
     * @return mixed array('pid'=>N1,'cid'=>N2,'did'=>N3) or false
     */
    public static function getPCDidFromNames($pName, $cName, $dName)
    {
        // find ID of data in Provinces Cities Districts Table.
        $pids=Lookup::idsLike(Provinces::tableName(), $pName);
        $cids=Lookup::idsLike(Cities::tableName(), $cName);
        $dids=Lookup::idsLike(Districts::tableName(), $dName);

        //load data to database in Districts Table.
        foreach ($dids as $did) {
            $model=Districts::findOne($did);
            foreach ($cids as $cid) {
                foreach ($pids as $pid) {
                    if ($model->pid == $pid['id'] && $model->cid == $cid['id']) {
                        return ['pid'=>$pid['id'],'cid'=>$cid['id'],'did'=>$did['id']];
                    }
                }
            }
        }
        return false;
    }

    public static function saveFromMSSQL($uploadUser, $import)
    {
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($import as $id) {
            $person = new Personinfo;
            $person->id = $uploadUser[$id]['id'];
            $person->original_id = $uploadUser[$id]['id'];
            $person->name = $uploadUser[$id]['real_name'];
            $person->job = $uploadUser[$id]['post'];
            $person->unit_code = $uploadUser[$id]['org'];
            $person->tel = $uploadUser[$id]['phone'];

            $person->sex = '男';
            $person->is_married = '否';
            $person->can_home_weekend = '否';
            $person->birthdate = '2000-01-01';
            $person->armydate = '2000-01-01';

            switch ($uploadUser[$id]['type']) {
                case 1:
                    $person->mil_rank = MilRank::LOWESTMOFFICER;
                    break;
                case 2:
                    $person->mil_rank = MilRank::STUDENTOFFICER;
                    break;
                case 3:
                    $person->mil_rank = MilRank::LOWESTENLISTED;
                    break;
            }

            if (!$person->save()) {
                var_dump($person->getErrors());
            } else {
                $sh = new StatisticsHoliday;
                $sh->id = $person->id;
                $sh->save();
            }
        }
        $transaction->commit();
    }

    public static function updateFromMSSQL($uploadUser, $update)
    {
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($update as $id) {
            Personinfo::updateAll(
                [
                    'job' => $uploadUser[$id]['post'],
                    'unit_code' => $uploadUser[$id]['org'],
                ],
                [
                    'id' => $id,
                ]
            );
        }
        $transaction->commit();
    }

    /**
     * current person set status.
     * @param $status_id Status id
     * @param $person_ids Array Personinfo id
     * @return boolen
     */
    public static function setStatusForAll($status_id, $person_ids)
    {
        return Personinfo::updateAll(
            [
                'status' => $status_id,
            ],
            [
                'id' => $person_ids,
            ]
        );
    }

    /**
     * @param array $ids Personinfo id
     *
     * @return boolen
     */
    public static function setLeaveForCanHomers($ids)
    {
        return Personinfo::updateAll(
            [
                'status' => Status::WEEKENDHOME,
            ],
            [
                'id' => $ids,
            ]
        );
    }

    /**
     * @return boolen
     */
    public static function setLeaveForHomers()
    {
        return Personinfo::updateAll(
            [
                'status' => Status::WEEKENDHOME,
            ],
            [
                'can_home_weekend' => '是',
                'status' => Status::HERE,
            ]
        );
    }

    /**
     * @return boolen
     */
    public static function setReturnForHomers()
    {
        return Personinfo::updateAll(
            [
                'status' => Status::HERE,
            ],
            [
                'can_home_weekend' => '是',
                'status' => Status::WEEKENDHOME,
            ]
        );
    }

    /**
     * @param array $ids Personinfo id
     *
     * @return boolen
     */
    public static function setReturnForCanHomers($ids)
    {
        return Personinfo::updateAll(
            [
                'status' => Status::HERE,
            ],
            [
                'id' => $ids,
            ]
        );
    }

    /**
     * @param $person_ids array Personinfo id
     * @return Personinfo instance
     */
    public static function getEtcNames($person_ids)
    {
        $persons = Personinfo::find()
            ->select('name')
            ->where(['id' => $person_ids])
            ->asArray()
            ->all();
        $names = '';
        foreach ($persons as $person) {
            $names .= $person['name'] . ' ';
        }
        return $names;
    }

    /**
     * current person set status.
     * @param $status_id Status id
     * @return boolen
     */
    public function setStatus($status_id)
    {
        $this->status = $status_id;
        return $this->save();
    }

    /**
     * current person is Overleave now?
     * @return boolen
     */
    public function getIsOverleave()
    {
        return $this->status === Status::OVERLEAVE_HOLIDAY || $this->status == Status::OVERLEAVE_OUT;
    }

    /**
     * current person is Holiday now?
     * @return boolen
     */
    public function getIsHoliday()
    {
        $_status = Status::findOne($this->status);
        return $_status->officer & Status::OFFICER;
    }

    /**
     * current person is Out now?
     * @return boolen
     */
    public function getIsOut()
    {
        return $this->status === Status::OUT;
    }

    /**
     * current person is here now?
     * @return boolen
     */
    public function getIsHere()
    {
        return $this->status === Status::HERE;
    }

    /**
     * if current personinfo is in holiday
     * this will return a holiday ActiveQuery
     * if cannot find throw Exception
     * @return Holiday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getCurrentHoliday()
    {
        $holiday = $this->hasOne(Holiday::className(), ['id' => 'id'])
            ->where([
                'date_cancel' => null,
            ]);

        if ($holiday == null) {
            throw new NotFoundHttpException('没有找到你的待销假的休假单。');
        }

        return $holiday;
    }

    /**
     * Finds the Districts model based on its primary key value.
     * @param string $id
     * @return Districts the loaded model
     */
    public function getDistrict()
    {
        $district_id = $this->parentshome_district;
        if ($district_id === null) {
            $district_id = $this->myhome_district;
            if ($district_id === null) {
                throw new NotFoundHttpException('你父母住址和配偶住址都没有设置，无法操作！');
            }
        }

        if (($model = Districts::findOne($district_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('找不到你设置的住址，请把父母住址或者配偶住址提交给管理员，以便录入。');
        }
    }

    public function getThisYearHolidays()
    {
        $holidays = $this->hasMany(Holiday::className(), ['id' => 'id'])
            ->where([
                'which_year' => date('Y'),
            ]);

        return $holidays;
        
    }
    
    /**
     * Finds this years holidays
     * @param array $ids personinfo
     * @param integer $status status code
     * @return boolean if all of them are the same status return true, else return false
     */
    public static function checkTheySameStatus($ids, $status)
    {
        $total = count($ids);
        $total_status =
                Personinfo::find()
                ->where([
                    'id' => $ids,
                    'status' => $status,
                ])
                ->count();
        return $total == $total_status;
    }

    public static function checkTheySameUnit($ids)
    {
        $unit_code = (new Query)
            ->select('unit_code')
            ->distinct(true)
            ->from(self::tableName())
            ->where(['id' => $ids]);
        if ($unit_code->count() != 1) {
            return false;
        } else {
            return $unit_code->one();
        }
    }

    /**
     * get the unit's can out information.
     * compare the data, and return whether is over proportion.
     * @param array $person_ids Personinfo id array.
     * @return mixed false or warning.
     */
    public static function checkOverOutProportion($person_ids)
    {
        return false;
    }

    /**
     * Finds this years holidays
     * @return
     */
    public function getThreeYearHolidays()
    {
        $lastyear = date('Y', strtotime('-1 year'));
        $thisyear = date('Y');
        $nextyear = date('Y', strtotime('+1 year'));
        $threeYear = [
            $lastyear,
            $thisyear,
            $nextyear,
        ];
        return $this->hasMany(Holiday::className(), ['id' => 'id'])
            ->where([
                'which_year' => [$threeYear],
            ])
            ->orderBy([
                'date_leave' => SORT_DESC,
            ]);
    }

    /**
     * Finds the StatisticsHoliday model based on its primary key value.
     * @return StatisticsHoliday the loaded model
     */
    public function getStatisticsHoliday()
    {
        if (($model = StatisticsHoliday::findOne($this->id)) !== null) {
            return $model;
        } else {
            $model = new StatisticsHoliday;
            $model->id = $this->id;
            $model->initYearDefaults();
            return $model;
        }
    }

    /**
     * @return boolen
     */
    public function getIsOlderUnmarried()
    {
        $year_birthdate = date('Y', strtotime($this->birthdate));
        return $year_birthdate < date('Y') - Yii::$app->setting->get('age_older_unmarried');
    }

    /**
     * @return string
     */
    public function getUnitFullName()
    {
        $unit = Unit::findOne($this->unit_code);
        $unit_tree = $unit->parents()->all();
        $unit_full_name = '';
        foreach ($unit_tree as $unit_node) {
            $unit_full_name .= $unit_node->name;
        }

        $unit_full_name .= $unit->name;

        return $unit_full_name;
    }

    /**
     * @return string
     */
    public function getMyhome()
    {
        $province = Lookup::itemQuery(Provinces::tableName(), $this->myhome_province);
        $city = Lookup::itemQuery(Cities::tableName(), $this->myhome_city);
        $district = Lookup::itemQuery(Districts::tableName(), $this->myhome_district);

        return $province . $city . $district;
    }

    /**
     * @return string
     */
    public function getParentshome()
    {
        $province = Lookup::itemQuery(Provinces::tableName(), $this->parentshome_province);
        $city = Lookup::itemQuery(Cities::tableName(), $this->parentshome_city);
        $district = Lookup::itemQuery(Districts::tableName(), $this->parentshome_district);

        return $province . $city . $district;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return Lookup::itemQuery(Status::tableName(), $this->status);
    }

    /**
     * @return string
     */
    public function getUnitName()
    {
        return Lookup::itemQuery(Unit::tableName(), $this->unit_code);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOut()
    {
        return $this->hasOne(Out::className(), ['id' => 'id']);
    }

    /**
     * Finds the Personinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Personinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Personinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * check whether out is over proportion
     * @param string|array $person_ids
     * @return boolean is Out over proportion?
     */
    public static function isOutOverProportion($person_ids)
    {
        $person_count = 1;
        if (is_array($person_ids)) {
            $person_count = count($person_ids);
            $unit_code = (new Query)
                ->select('unit_code')
                ->distinct(true)
                ->from(self::tableName())
                ->where(['id' => $person_ids]);
            $unit_count = $unit_code->count();
            $unit_code = $unit_code->one();
            if ($unit_count > 1) {
                return true;
            }
        } else {
            $unit_code = self::findOne($person_ids)
                ->unit_code;
        }

        $areSoldiers = self::areSoldiers($person_ids);

        $proportion = self::calculateOutProportion($person_count, $unit_code);

        return Unit::isOverProportion($proportion, $unit_code, Unit::TYPE_OUT, $areSoldiers);
    }

    /**
     * calculate proportion of out in unit
     * @param integer $person_count
     * @param integer $unit_code
     * @return boolean is Out over proportion?
     */
    public static function calculateOutProportion($person_count, $unit_code)
    {
        $count_here_out = self::find()
        ->where([
            'unit_code' => $unit_code
        ])
        ->andWhere([
            'in', 'status', [Status::HERE, Status::OUT]
        ])->count();

        $count_out = self::find()
        ->where([
            'unit_code' => $unit_code,
            'status' => Status::OUT
        ])->count() + $person_count;

        if ($count_here_out == 0) {
            return 0;
        } else {
            return $count_out / $count_here_out;
        }
    }

    /**
     * Personinfos who can go home
     * at weekend in Unit someone
     *
     * @param integer $unit_code unit's code
     *
     * @return Query who can go home at weekend
     */
    public static function personsWhoCanWeekendHome($unit_code)
    {
        $children = Unit::findOne($unit_code)->children()->all();
        $unit_codes = [$unit_code];
        foreach ($children as $child) {
            $unit_codes[] = $child->id;
        }
        return self::findAll([
            'unit_code' => $unit_codes,
            'can_home_weekend' => '是',
        ]);
    }

    /**
     * delete all of them, and save them to Personbye
     * @param array $ids personinfo
     * @return integer count of deleted successfully
     */
    public static function bye($ids)
    {
        Personbye::backup($ids);
        $count = self::deleteAll([
            'id' => $ids,
        ]);
        Unit::refreshCountsALL();
        return $count;
    }

    /**
     * update all of them
     * @param array $ids personinfo ids
     * @param integer $unit unit code
     * @return integer count of updated successfully
     */
    public static function assign($ids, $unit)
    {
        $count = self::updateAll(
            ['unit_code' => $unit],
            ['id' => $ids]
        );
        Unit::refreshCountsALL();
        return $count;
    }

    public function getIsSoldier()
    {
        return $this->mil_rank < MilRank::LOWESTMOFFICER;
    }

    public function isSoldier()
    {
        return $this->mil_rank < MilRank::LOWESTMOFFICER;
    }

    public static function areSoldiers($person_ids)
    {
        $person_count = 1;
        if (is_array($person_ids)) {
            $person_count = count($person_ids);
        }
        $soldier_count = (new Query)
            ->select('id')
            ->from(self::tableName())
            ->where(['id' => $person_ids])
            ->andWhere(['<', 'mil_rank', MilRank::LOWESTMOFFICER])
            ->count();

        return $soldier_count == $person_count;
    }
}
