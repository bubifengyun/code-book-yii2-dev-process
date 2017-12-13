<?php

use yii\helpers\Html;
use common\models\Unit;
use kartik\tree\TreeView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '单位设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">

    <?= TreeView::widget([
        'query'             => Unit::find()->addOrderBy('root, lft'),
        'headingOptions'    => ['label' => '部别'],
        'nodeAddlViews'     => [
            '2' => '@frontend/views/unit/showothers',
        ],
        'isAdmin'           => false,
        'rootOptions'       => ['label' => '您可以查看的部别'],
]) ?>

</div>
