<?php

namespace common\models;

use Yii;

/**
 * 这里有如下几种类型的查询方式。
 *
 * 第一种：原始代码存在的，数据都存在数据表"{{%lookup}}"
 * 对应于items, item, loaditems
 *
 * 第二种：后续添加，不涉及数据表"{{%lookup}}"
 * 对应与itemsquery, itemquery, loaditemsquery,
 *
 * 第三种：后续添加，不涉及数据表"{{%lookup}}"
 * 用于已知name，查询id或者近似name，查询id
 * 对应于id, idslike, loaditemids,
 *
 * 第四种：专门用于查询user用户的
 * 对应于Users, loadusers
 *
 * 第五种：专门回馈休假类型
 * 对应于StatusHoliday, loadStatusHoliday
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends \yii\db\ActiveRecord
{
    const TASK_READYWAR = 9;
    const TASK_WEEKEND = 1;
    const TASK_WORK = 0;

    private static $_items=[];
    private static $_users=[];
    private static $_item_ids=[];
    private static $_items_query=[];
    private static $_status_holiday=[];
    private static $_filter_status_for_out=[];
    private static $_filter_status_for_holiday=[];
    private static $_filter_mil_rank=[];
    private static $_roles=[];
    private static $_proportions=[];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名字',
            'code' => '代码',
            'type' => '分类',
            'position' => '排序',
        ];
    }

    public static function StatusHoliday()
    {
        if (self::$_status_holiday === []) {
            self::loadStatusHoliday();
        }
        return self::$_status_holiday;
    }

    public static function FilterStatusForHoliday()
    {
        if (self::$_filter_status_for_holiday === []) {
            self::loadFilterStatusForHoliday();
        }
        return self::$_filter_status_for_holiday;
    }

    public static function FilterStatusForOut()
    {
        if (self::$_filter_status_for_out === []) {
            self::loadFilterStatusForOut();
        }
        return self::$_filter_status_for_out;
    }

    public static function Users()
    {
        if (self::$_users === []) {
            self::loadUsers();
        }
        return self::$_users;
    }

    public static function Roles()
    {
        if (self::$_roles=== []) {
            self::loadRoles();
        }
        return self::$_roles;
    }

    public static function Proportions()
    {
        if (self::$_proportions=== []) {
            self::loadProportions();
        }
        return self::$_proportions;
    }

    public static function itemsQuery($type)
    {
        if (!isset(self::$_items_query[$type])) {
            self::loadItemsQuery($type);
        }
        return self::$_items_query[$type];
    }

    public static function items($type)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
            return self::$_items[$type];
    }
    
    public static function idsLike($type, $name)
    {
        $ids = (new \yii\db\Query())
            ->select(['id'])
            ->from($type)
            ->where(['like', 'name', [$name]])
            ->all();

        return $ids;
    }
    
    public static function id($type, $name)
    {
        if (!isset(self::$_item_ids[$type])) {
            self::loadItemIds($type);
        }

        return isset(self::$_item_ids[$type][$name]) ? self::$_item_ids[$type][$name] : false;
    }
    
    public static function itemQuery($type, $code)
    {
        if (!isset(self::$_items_query[$type])) {
            self::loadItemsQuery($type);
        }
        return isset(self::$_items_query[$type][$code]) ? self::$_items_query[$type][$code] : false;
    }

    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }
    
    private static function loadItemIds($type)
    {
        self::$_item_ids[$type]=[];
        $id_items = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from($type)
            ->all();
        foreach ($id_items as $id_item) {
            self::$_item_ids[$type][$id_item['name']] = $id_item['id'];
        }
    }
    
    private static function loadStatusHoliday()
    {
        self::$_status_holiday =
            yii\helpers\ArrayHelper::map(
                Status::find()
                ->where('officer & ' . Status::OFFICER)
                ->orderBy('id')
                ->asArray()
                ->all(),
                'id',
                'name'
            );
    }
    
    private static function loadFilterStatusForHoliday()
    {
        $_tmp_result =
            yii\helpers\ArrayHelper::map(
                Status::find()
                ->where(['>', 'id', Status::OVERLEAVE])
                ->orderBy('id')
                ->asArray()
                ->all(),
                'id',
                'name'
            );
        $allHolidayIds = implode(',', array_keys($_tmp_result));
        self::$_filter_status_for_holiday = [
            Status::HERE => Lookup::itemQuery(Status::tableName(), Status::HERE),
            Status::OVERLEAVE => Lookup::itemQuery(Status::tableName(), Status::OVERLEAVE),
            $allHolidayIds => '休假',
        ];
    }
    
    private static function loadFilterStatusForOut()
    {
        self::$_filter_status_for_out =
            yii\helpers\ArrayHelper::map(
                Status::find()
                ->where(['<=', 'id', Status::OVERLEAVE])
                ->orderBy('id')
                ->asArray()
                ->all(),
                'id',
                'name'
            );
    }
    
    private static function loadUsers()
    {
        self::$_users =
            yii\helpers\ArrayHelper::map(
                User::find()
                ->orderBy('id')
                ->asArray()
                ->all(),
                'id',
                'username'
            );
    }
    
    private static function loadRoles()
    {
        self::$_roles =
            yii\helpers\ArrayHelper::map(
                (new \yii\db\Query())
                ->where(['type'=>1]) // 1 for roles
                ->from('{{%auth_item}}')
                ->all(),
                'name',
                'description'
            );
    }

    public static function proportion($id)
    {
        if (!isset(self::$_proportions[$id])) {
            self::loadProportions();
        }
        return isset(self::$_proportions[$id]) ? self::$_proportions[$id] : false;
    }

    private static function loadProportions()
    {
        self::$_proportions=
            yii\helpers\ArrayHelper::map(
                Proportion::find()
                ->orderBy('id')
                ->asArray()
                ->all(),
                'id',
                'proportion'
            );
    }

    private static function loadItemsQuery($type)
    {
        self::$_items_query[$type]=[];
        $id_items = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from($type)
            ->all();
        foreach ($id_items as $id_item) {
            self::$_items_query[$type][$id_item['id']] = $id_item['name'];
        }
    }
    
    private static function loadItems($type)
    {
            self::$_items[$type]=[];
            $models=self::findAll(['type' => $type]);
        foreach ($models as $model) {
            self::$_items[$type][$model->code]=$model->name;
        }
    }
}
