<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Lookup;
use common\models\MilRank;
use common\models\Status;
use common\models\HolidaySearch;
use kartik\grid\GridView;
use kartik\tree\TreeView;
use kartik\mpdf\Pdf;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '在位状态变化信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    .view{padding:0;word-wrap:break-word;cursor:text;height:90%;}
    body{margin:8px;font-family:sans-serif;font-size:16px;}
    p{margin:5px 0;}
</style>

<link rel="stylesheet" type="text/css">

<style id="table">
    .selectTdClass{background-color:#edf5fa !important}
    table.noBorderTable 
    td,
    table.noBorderTable 
    th,table.noBorderTable 
    caption{border:1px dashed #ddd !important}
    table{margin-bottom:10px;border-collapse:collapse;display:table;}
    td,
    th{padding: 5px 10px;border: 1px solid #DDD;}
    caption{border:1px dashed #DDD;border-bottom:0;padding:3px;text-align:center;}
    th{border-top:1px solid #BBB;background-color:#F7F7F7;}
    table 
        tr.firstRow th{border-top-width:2px;}
        .ue-table-interlace-color-single{ background-color: #fcfcfc; } 
        .ue-table-interlace-color-double{ background-color: #54c3d0; }
        td 
        p{margin:0;padding:0;}
</style>
<hr/>
<h3>一、基本信息</h3>
<table data-sort="sortDisabled" interlaced="enabled">
    <tbody>
        <tr class="ue-table-interlace-color-single firstRow" align="center">
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="120">
                状态  
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="200">
                <?= Html::tag('span', $model->statusName, ['style' => ['color' => 'red']]) ?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="120">
                婚否
            </td>
            <td style="border-width: 1px; border-style: solid;" width="120">
                <?= $model->is_married?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="120">
                周末回家
            </td>
            <td style="border-width: 1px; border-style: solid;" width="90">
                <?= $model->can_home_weekend?>
            </td>
            <td rowspan="4" colspan="1" style="border-width: 1px; border-style: solid;" width="200">

        <?php //echo CHtml::image($model->getMyFolder().'/'.$model->photo,'该同志没有设置照片', array('width'=>163,'height'=>137));
?>
                <?= Html::img('@web/images/cat.jpg', ['alt' => '用户头像', /*'width' => 90,*/ 'height' => 150]) ?>
            </td>
        </tr>
        <tr class="ue-table-interlace-color-double" align="center">
            <td style="word-break: break-all; border-width: 1px; border-style: solid;">
                部别
            </td>
            <td rowspan="1" colspan="5" style="border-width: 1px; border-style: solid;" width="344">
                <?= $model->unitFullName ?>
            </td>
        </tr>
        <tr class="ue-table-interlace-color-single">
            <td style="word-break: break-all; border-width: 1px; border-style: solid;">
                配偶住址
            </td>
            <td rowspan="1" colspan="2" style="border-width: 1px; border-style: solid;" width="194">
                <?= $model->myhome ?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="69">
                父母住址
            </td>
            <td rowspan="1" colspan="2" style="border-width: 1px; border-style: solid;" width="383">
                <?= $model->parentshome ?>
            </td>
        </tr>
        <tr class="ue-table-interlace-color-double">
            <td style="word-break: break-all; border-width: 1px; border-style: solid;">
                出生日期
            </td>
            <td rowspan="1" colspan="1" style="border-width: 1px; border-style: solid;" width="194">
                <?= $model->birthdate;?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="120">
                入伍日期
            </td>
            <td rowspan="1" colspan="1" style="border-width: 1px; border-style: solid;" width="383">
                <?= $model->armydate;?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="120">
                性别
            </td>
            <td style="border-width: 1px; border-style: solid;" width="90">
                <?= $model->sex;?>
            </td>
        </tr>
        <tr class="ue-table-interlace-color-single">
            <td style="word-break: break-all; border-width: 1px; border-style: solid;">
                游戏数值 
            </td>
            <td rowspan="1" colspan="1" style="border-width: 1px; border-style: solid;" width="148">
                <?= Lookup::itemQuery(MilRank::tableName(), $model->mil_rank) ?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="78">
                职务
            </td>
            <td rowspan="1" colspan="2" style="border-width: 1px; border-style: solid;" width="285">
                <?= $model->job;?>
            </td>
            <td style="word-break: break-all; border-width: 1px; border-style: solid;" width="82">
                电话
            </td>
            <td rowspan="1" colspan="1" style="border-width: 1px; border-style: solid;" width="182">
                <?= $model->tel;?>
            </td>
        </tr>
        <tr class="ue-table-interlace-color-double">
        </tr>
    </tbody>
</table>

<hr>

<h3>二、休假统计信息</h3>

<div class="personinfo-view">

    <?= kartik\detail\DetailView::widget([
        'model' => $model->statisticsHoliday,
        'condensed'=>true,
        'hover'=>true,
        'attributes' => [
            'day_total',
            'day_left_lastyear',
            'day_lend_nextyear',
            'day_lend_nextyear_ps',
            'day_left',
            'day_add',
            'day_add_ps',
            'day_path',
        ],
    ]) ?>

</div>

<hr>
<h3>三、去年今年假单列表</h3>

<?php

$searchModel = new HolidaySearch();
$searchModel->id = $model->id;
$thisyear = date('Y');
//$searchModel->which_year = [$thisyear-1, $thisyear];

$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

echo GridView::widget([
    'id' => 'admin-gridview-id',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'kartik\grid\SerialColumn'
        ],
        [
            'attribute' => 'which_year',
            'filter'=> [($thisyear-1)=>($thisyear-1),$thisyear=>$thisyear],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        'date_leave',
        'date_cancel',
        'date_come',
        [
            'attribute' => 'kind',
            'value' => function ($model, $key, $widget) {
                return Lookup::itemQuery(Status::tableName(), $model->kind);
            },
        ],
        'where_leave',
    ],
    'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
    //    'heading' => $selfUnit->name,
    ],
]);
