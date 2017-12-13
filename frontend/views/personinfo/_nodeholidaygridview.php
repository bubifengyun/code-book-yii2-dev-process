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
$filename = $selfUnit->name.'休假情况';
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
        'parentshome',
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
            'template' => '{view-my-holidays}--{mixed}',
            'buttons' => [
                'view-my-holidays' => function ($url, $model, $key) {
                    $label = '<span style="color:green" class="fa fa-eye"></span>';
                    $url = Url::to(['view', 'id' => $key]);
                    $options = [
                        'title' => '休假信息',
                        'data-pjax' => '0',
                    ];
                    return Html::a(
                        $label,
                        $url,
                        $options
                    );
                },
                'mixed' => function ($url, $model, $key) {
                    if ($model->isHere) {
                        $label = '<span style="color:green" class="fa fa-plane"></span>';
                        $url = Url::to(['holiday/leave', 'id' => $key]);
                        $options = [
                            'title' => '休假',
                            'data-pjax' => '0',
                        ];
                    } elseif ($model->isHoliday) {
                        $label = '<span style="color:orange" class="fa fa-undo"></span>';
                        $url = Url::to(['holiday/cancel', 'id' => $key]);
                        $options = [
                            'title' => '销假',
                            'data-pjax' => '0',
                        ];
                    } elseif ($model->isOut) {
                        $label = '<span style="color:black" class="fa fa-bicycle"></span>';
                        $url = '#';
                        //$url = Url::to(['out/cancel', 'id' => $key]);
                        $options = [
                            'title' => '外出中',
                            'data-pjax' => '0',
                        ];
                    } elseif ($model->isOverleave) {
                        $label = '<span style="color:red" class="fa fa-exclamation-triangle"></span>';
                        $url = Url::to(['out/cancel', 'id' => $key]);
                        //$url = Url::to(['out/cancel', 'id' => $key]);
                        $options = [
                            'title' => '逾假',
                            'data-pjax' => '0',
                        ];
                    } else {
                        $label = '<span style="color:black" class="fa fa-ban"></span>';
                        $url = '#';
                        $options = [
                            'title' => '无权操作',
                            'data-pjax' => '0',
                        ];
                    }
                    return Html::a(
                        $label,
                        $url,
                        $options
                    );
                },
            ]
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
