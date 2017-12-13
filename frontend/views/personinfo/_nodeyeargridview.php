<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\tree\TreeView;
use kartik\mpdf\Pdf;
use common\models\Personinfo;
use common\models\PersoninfoSearch;
use common\models\Unit;
use common\models\Lookup;
use common\models\MilRank;
use common\models\Status;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */
/* @var $form yii\widgets\ActiveForm */

// run every key=>value as variant in PHP.
extract($params);

$selfUnit = Unit::findOne($node->id);
$filename = date('Y年') . $selfUnit->name.'干部休假情况';
$exportConfigForChinese = [
    'xls' => [
        'filename' => $filename,
        'config' => [
            'worksheet' => $filename,
        ],
    ],
    'txt' => [
        'filename' => $filename,
        'showHeader' => true,
    ],
    'pdf' => [
        'filename' => $filename,
        'config' => [
            'mode' => Pdf::MODE_UTF8,
            'options' => [
                'title' => $filename,
                'autoLangToFont' => true,
                'autoScriptToLang' => true,
                'autoVietnamese' => true,
                'autoArabic' => true,
            ],
        ],
    ],
];

$children = $selfUnit->children()->all();
$selfAndChildrenID = [$node->id];
foreach ($children as $child) {
    $selfAndChildrenID[] = $child->id;
}

$searchModel = new PersoninfoSearch();
$searchModel->unit_code = $selfAndChildrenID;
//$searchModel->status = $holidayRelatedStatus;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

echo GridView::widget([
    'id' => 'admin-gridview-id',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'kartik\grid\SerialColumn',
            'header' => '序号',
        ],
        [
            'attribute' => 'name',
            'mergeHeader'=>true,
            'width' => '100px',
            'hAlign'=>'center',
        ],
        [
            'attribute' => 'armydate',
            'mergeHeader'=>true,
            'width' => '50px',
            'hAlign'=>'center',
            'value' => function ($model, $key, $index) {
                return date('Y.m', strtotime($model->armydate));
            },
        ],
        [
            'attribute'=>'hometown',
            'mergeHeader'=>true,
            'width' => '150px',
            'hAlign'=>'center',
        ],
        [
            'header' => '假期类型',
            'mergeHeader'=>true,
            'width' => '150px',
            'hAlign'=>'center',
            'value' => function ($model, $key, $index) {
                return $model->statisticsHoliday->typename;
            },
        ],
        [
            'attribute'=>'statisticsHoliday.day_standard',
            'header' => '休假标准',
            'mergeHeader'=>true,
            'width' => '50px',
            'hAlign'=>'center',
        ],
        [
            'attribute'=>'statisticsHoliday.day_path',
            'header' => '路途',
            'mergeHeader'=>true,
            'width' => '30px',
            'hAlign'=>'center',
        ],
        [
            'header' => '已休天数',
            'mergeHeader'=>true,
            'width' => '50px',
            'hAlign'=>'center',
            'value' => function ($model, $key, $index) {
                return $model->statisticsHoliday->day_total - $model->statisticsHoliday->day_left;
            }
        ],
        [
            'attribute'=>'statisticsHoliday.day_left',
            'header' => '剩余天数',
            'mergeHeader'=>true,
            'width' => '50px',
            'hAlign'=>'center',
        ],
    ],
    'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'floatHeaderOptions' => ['top' => 10],
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => $selfUnit->name,
    ],
    'exportConfig'=>$exportConfigForChinese,
]);
