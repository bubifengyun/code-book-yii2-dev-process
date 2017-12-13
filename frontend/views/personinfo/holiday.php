<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tree\TreeView;
use kartik\tree\Module;
use common\models\Unit;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = '休假管理';
$this->params['breadcrumbs'][] = ['label' => '所有人员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-view">

<?= TreeView::widget([
    'query'             => $query,
    'headingOptions'    => ['label' => '部别'],
    'nodeView'          => '@frontend/views/personinfo/_nodeholidaygridview',
    'nodeActions' => [
        Module::NODE_MANAGE => Url::to(['treemanager-router', 'router' => 'holiday']),
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
