<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Unit;
use kartik\tree\TreeView;
use kartik\tree\Module;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = '退伍和分配管理';
$this->params['breadcrumbs'][] = ['label' => '所有人员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-view">

<?= TreeView::widget([
    'query'             => $query,
    'headingOptions'    => ['label' => '部别'],
    'nodeView'          => '@frontend/views/personinfo/_nodebyegridview',
    'nodeActions' => [
        Module::NODE_MANAGE => Url::to(['treemanager-router', 'router' => 'bye']),
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
