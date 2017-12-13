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

$heading = date('m').'月份全单位士官探亲休假报表';

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
    'showPageSummary'=>true,
    'pjax'=>true,
    'striped'=>true,
    'hover'=>true,
    'panel'=>['type'=>'primary', 'heading'=>$heading],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],
        [
            'attribute' => 'name',
            'width' => '150px',
            'pageSummary'=>'总计：',
        ],
        [
            'attribute' => 'count_senior_soldier',
            'width' => '90px',
            'mergeHeader'=>true,
            'pageSummary'=>true,
        ],
        [
            'attribute' => 'currentCountSeniorSoldierInHoliday',
            'mergeHeader'=>true,
            'width' => '90px',
            'pageSummary'=>true,
        ],
        [
            'header' => '正在探亲休假名单',
            'mergeHeader'=>true,
            'format' => 'html',
            'value'=>function ($model, $key, $index, $widget) {
                return Unit::personNamesToHtml($model->currentSeniorSoldierInHoliday);
            },
        ],
        [
            'attribute' => 'currentCountSeniorSoldierCompleteHoliday',
            'width' => '90px',
            'mergeHeader'=>true,
            'pageSummary'=>true,
        ],
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'完成比例(%)',
            'value'=>function ($model, $key, $index, $widget) {
                $p = compact('model', 'key', 'index');
                if ($widget->col(2, $p) == 0) {
                    return 0;
                }
                return (100 * $widget->col(5, $p)) / $widget->col(2, $p);
            },
            'mergeHeader'=>true,
            'width'=>'90px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
        ],
    ],
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'floatHeaderOptions' => ['top' => 10],
    'exportConfig'=>$exportConfigForChinese,
]);
