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

Pjax::begin();
// run every key=>value as variant in PHP.
extract($params);

$selfUnit = Unit::findOne($node->id);
$filename = $selfUnit->name.'人员列表';
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
            'class' => 'kartik\grid\SerialColumn'
        ],
        'name',
        [
            'attribute' => 'armydate',
            'value' => function ($model) {
                return date('Y年m月', strtotime($model->armydate));
            },
        ],
        'myhome',
        [
            'attribute' => 'is_married',
            'filter'=> ['是'=>'是','否'=>'否'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        [
            'attribute' => 'can_home_weekend',
            'filter'=> ['是'=>'是','否'=>'否'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        [
            'attribute'=>'status',
            'value' => function ($model) {
                return Lookup::itemQuery(Status::tableName(), $model->status);
            },
            //下面语句在排序选择为空时，会把所有状态的人都拿出来。
            'filter'=> Lookup::itemsQuery(Status::tableName()),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        [
            'attribute'=>'mil_rank',
            'value' => function ($model) {
                return Lookup::itemQuery(MilRank::tableName(), $model->mil_rank);
            },
            'filter'=>ArrayHelper::map(MilRank::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view}--{update}',
        ],
    ],
    'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'toolbar' =>  [
        '{export}',
        '{toggleData}'
    ],
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
Pjax::end();
