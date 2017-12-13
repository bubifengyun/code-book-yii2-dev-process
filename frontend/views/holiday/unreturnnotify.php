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

$heading = Yii::$app->setting->get('day_unreturn_notify')
    . '天之内临近归队士官名单';
$this->title = $heading;
$this->params['breadcrumbs'][] = $this->title;

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
            'attribute' => 'owner.name',
            'width' => '150px',
            'mergeHeader'=>true,
        ],
        [
            'attribute' => 'owner.unitName',
            'width' => '150px',
            'mergeHeader'=>true,
        ],
        'date_leave',
        'date_come',
        [
            'attribute'=>'kind',
            'value' => function ($model) {
                return Lookup::itemQuery(Status::tableName(), $model->kind);
            },
            //下面语句在排序选择为空时，会把所有状态的人都拿出来。
            'filter'=> Lookup::itemsQuery(Status::tableName()),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
        'where_leave',
        'ps',
    ],
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'floatHeaderOptions' => ['top' => 10],
    'exportConfig'=>$exportConfigForChinese,
]);
