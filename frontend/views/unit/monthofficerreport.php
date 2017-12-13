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

$heading = date('Y年m月').'干部休假情况统计表';

$filename = $heading;
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
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'primary', 'heading'=>$heading],
    'columns'=>[
        [
            'class'=>'common\models\SerialColumnForGBK',
            'header' => '序号',
        ],
        [
            'attribute'=>'id',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->owner->unit->upParent->name;
            },
            'hAlign'=>'center',
            'filterType'=>GridView::FILTER_SELECT2,
            'group'=>true,  // enable grouping,
            'groupedRow'=>true,                    // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
        ],
        [
            'attribute' => 'owner.name',
            'mergeHeader'=>true,
            'width' => '150px',
            'hAlign'=>'center',
        ],
        [
            'attribute' => 'owner.unit.name',
            'mergeHeader'=>true,
            'header' => '部职别',
            'width' => '150px',
            'hAlign'=>'center',
        ],
        [
            'attribute' => 'where_leave',
            'mergeHeader'=>true,
            'width' => '150px',
            'hAlign'=>'center',
        ],
        [
            'attribute' => 'date_leave',
            'mergeHeader'=>true,
            'hAlign'=>'center',
            'value'=>function ($model, $key, $index, $widget) {
                return date('Y年m月d日', strtotime($model->date_leave));
            },
        ],
        [
            'attribute' => 'date_come',
            'mergeHeader'=>true,
            'hAlign'=>'center',
            'value'=>function ($model, $key, $index, $widget) {
                $result = $model->date_cancel;
                if ($model->date_cancel == null) {
                    $result = $model->date_come;
                }
                if ($result == null) {
                    return '';
                }
                return date('Y年m月d日', strtotime($result));
            },
        ],
        [
            'attribute' => 'ps',
            'width' => '150px',
            'mergeHeader'=>true,
            'hAlign'=>'center',
        ],
    ],
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'floatHeaderOptions' => ['top' => 10],
    'exportConfig'=>$exportConfigForChinese,
]);
