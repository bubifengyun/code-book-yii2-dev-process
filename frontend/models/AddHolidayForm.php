<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * AddHolidayForm class.
 * AddHolidayForm is the data structure for adding or minus
 * the number of holiday.
 * The adding or minus number must be integer.
 */
class AddHolidayForm extends Model
{
    public $day_add;
    public $day_add_ps;
    public $type;
    public $day_add_is_nextyear;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day_add', 'day_add_is_nextyear', 'type'], 'required'],
            [['day_add', 'day_add_is_nextyear'], 'integer'],
            [['day_add_ps'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'day_add' => '今年增减的假期天数',
            'day_add_is_nextyear' => '这些天数是否从明年借',
            'day_add_ps' => '假期增减说明',
            'type' => '假期类型',
        ];
    }
}
