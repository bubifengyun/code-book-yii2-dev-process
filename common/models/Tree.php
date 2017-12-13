<?php

namespace common\models;

use Yii;

class Tree extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tree}}';
    }
}
