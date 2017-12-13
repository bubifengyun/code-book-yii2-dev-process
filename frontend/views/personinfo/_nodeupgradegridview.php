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

$kind = isset($_GET['kind']) ? $_GET['kind'] : 'job';

$next_date = 'next_other_date';
$columns = [
    [
        'class' => 'kartik\grid\SerialColumn'
    ],
    'name',
];
switch ($kind) {
    case 'job':
        $next_date = 'next_other_date';
        $columns[] = 'next_other_date';
        $columns[] = 'job';
        break;
    case 'tech':
        $next_date = 'next_techgrade_date';
        $columns[] = 'next_techgrade_date';
        $columns[] = 'tech_grade';
        break;
    case 'rank':
        $next_date = 'next_mil_rank_date';
        $columns[] = 'next_mil_rank_date';
        $columns[] =
            [
                'attribute'=>'mil_rank',
                'value' => function ($model) {
                    return Lookup::itemQuery(MilRank::tableName(), $model->mil_rank);
                },
                'filter'=>ArrayHelper::map(MilRank::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
            ];
        break;
}

$columns[] =
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view}--{update}',
    ];

$selfUnit = Unit::findOne($node->id);
$filename = $selfUnit->name.'需要晋职晋级晋衔情况';
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
$dataProvider->query->where([
    'and',
    ['>', $next_date, date('Y-m-d', strtotime('-3 month'))],
    ['<', $next_date, date('Y-m-d', strtotime('+3 month'))],
]);
$dataProvider->refresh();


echo GridView::widget([
    'id' => 'admin-gridview-id',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
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
