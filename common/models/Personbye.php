<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%personbye}}".
 *
 * @property string $id
 * @property string $name
 * @property string $namepinyin
 * @property string $sex
 * @property string $is_married
 * @property string $is_with_spouse
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
 */
class Personbye extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%personbye}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'sex', 'is_married', 'is_with_spouse', 'can_home_weekend', 'birthdate', 'armydate', 'mil_rank', 'unit_code', 'job'], 'required'],
            [['sex', 'is_married', 'is_with_spouse', 'property', 'can_home_weekend'], 'string'],
            [['birthdate', 'armydate', 'current_mil_rank_date', 'next_mil_rank_date', 'current_techgrade_date', 'next_techgrade_date', 'current_other_date', 'next_other_date'], 'safe'],
            [['status', 'mil_rank', 'unit_code', 'myhome_province', 'myhome_city', 'myhome_district', 'parentshome_province', 'parentshome_city', 'parentshome_district'], 'integer'],
            [['id', 'tech_grade', 'job', 'tel'], 'string', 'max' => 32],
            [['name', 'photo'], 'string', 'max' => 64],
            [['namepinyin'], 'string', 'max' => 128],
            [['hometown'], 'string', 'max' => 56],
            [['qrcode'], 'string', 'max' => 256],
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
            'is_with_spouse' => '配偶随队',
            'property' => '党团情况',
            'photo' => '照片',
            'can_home_weekend' => '周末回家',
            'birthdate' => '出生日期',
            'armydate' => '入伍日期',
            'current_mil_rank_date' => '当前军衔日期',
            'next_mil_rank_date' => '下次晋衔日期',
            'current_techgrade_date' => '当前级别日期',
            'next_techgrade_date' => '下次晋级日期',
            'current_other_date' => '当前其他日期',
            'next_other_date' => '下次更改日期',
            'status' => '在位状态',
            'mil_rank' => '军衔',
            'unit_code' => '部别',
            'tech_grade' => '技术等级',
            'job' => '职务',
            'tel' => '电话',
            'myhome_province' => '配偶住址（省级）',
            'myhome_city' => '配偶住址（市级）',
            'myhome_district' => '配偶住址（县级）',
            'parentshome_province' => '父母住址（省级）',
            'parentshome_city' => '父母住址（市级）',
            'parentshome_district' => '父母住址（县级）',
            'hometown' => '籍贯',
            'qrcode' => '二维码',
        ];
    }

    /**
     * backup Personinfo to Personbye
     * @param array $ids Personinfo id
     * @return boolean true for success
     */
    public static function backup($ids)
    {
        $personinfos = Personinfo::findAll($ids);
        $personbye = new Personbye;
        $pre = date('Ym');
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($personinfos as $personinfo) {
            $personbye->attributes = $personinfo->attributes;
            $personbye->id = $pre . $personinfo->id;
            $personbye->isNewRecord = true;
            $personbye->save();
        }
        $transaction->commit();
    }
}
