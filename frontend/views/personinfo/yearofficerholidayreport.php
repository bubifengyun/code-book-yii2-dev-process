<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Unit;
use kartik\tree\TreeView;
use kartik\tree\Module;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = date('Y') . '年度车马炮休假情况';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-view">

<?= TreeView::widget([
    'query'             => $query,
    'headingOptions'    => ['label' => '部别'],
    'nodeView'          => '@frontend/views/personinfo/_nodeyeargridview',
    'nodeActions' => [
        Module::NODE_MANAGE => Url::to(['treemanager-router', 'router' => 'year-officer-holiday-report']),
    ],
    'isAdmin'           => false,
    'rootOptions'       => ['label' => '您可以查看的部别'],
    'displayValue'      => $current_unit,
    'toolbar'           => [
        TreeView::BTN_REFRESH => false,
        TreeView::BTN_CREATE => false,
        TreeView::BTN_CREATE_ROOT => false,
        TreeView::BTN_REMOVE => false,
        TreeView::BTN_SEPARATOR => false,
        TreeView::BTN_MOVE_UP => false,
        TreeView::BTN_MOVE_DOWN => false,
        TreeView::BTN_MOVE_LEFT => false,
        TreeView::BTN_MOVE_RIGHT => false,
        TreeView::BTN_SEPARATOR => false,
    ],
]) ?>

</div>
