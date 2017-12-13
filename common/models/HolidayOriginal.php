<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%holiday_original}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $department
 * @property string $grade
 * @property string $hunfou
 * @property string $ParentLocation
 * @property string $WifeLocation
 * @property string $towhere
 * @property string $leavetime
 * @property string $backtime
 * @property string $waytime
 * @property string $reason
 * @property string $leaveOrback
 * @property string $section
 * @property string $backtimereal
 * @property integer $consumeDays
 * @property integer $totalDays
 * @property integer $xiujiaday
 * @property integer $otherday
 * @property integer $year
 */
class HolidayOriginal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%holiday_original}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'department', 'grade', 'hunfou', 'ParentLocation', 'WifeLocation', 'towhere', 'leavetime', 'backtime', 'waytime', 'reason', 'leaveOrback', 'section', 'backtimereal', 'consumeDays', 'totalDays', 'xiujiaday', 'otherday', 'year'], 'required'],
            [['id', 'consumeDays', 'totalDays', 'xiujiaday', 'otherday', 'year'], 'integer'],
            [['name', 'department', 'grade', 'hunfou', 'ParentLocation', 'WifeLocation', 'towhere', 'leavetime', 'backtime', 'waytime', 'reason', 'leaveOrback', 'section', 'backtimereal'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'department' => 'Department',
            'grade' => 'Grade',
            'hunfou' => 'Hunfou',
            'ParentLocation' => 'Parent Location',
            'WifeLocation' => 'Wife Location',
            'towhere' => 'Towhere',
            'leavetime' => 'Leavetime',
            'backtime' => 'Backtime',
            'waytime' => 'Waytime',
            'reason' => 'Reason',
            'leaveOrback' => 'Leave Orback',
            'section' => 'Section',
            'backtimereal' => 'Backtimereal',
            'consumeDays' => 'Consume Days',
            'totalDays' => 'Total Days',
            'xiujiaday' => 'Xiujiaday',
            'otherday' => 'Otherday',
            'year' => 'Year',
        ];
    }

    /**
     * @return Unit instance
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['name' => 'department']);
    }
}
