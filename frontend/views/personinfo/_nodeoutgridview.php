<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
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
use common\models\PublicFunction;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */
/* @var $form yii\widgets\ActiveForm */

// run every key=>value as variant in PHP.
extract($params);

$selfUnit = Unit::findOne($node->id);
$filename = $selfUnit->name.'外出情况';
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
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$manyleave = Url::to(['/out/many-leave']);
$manycancel = Url::to(['/out/many-cancel']);

$jsonlick_manyleave = <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    $.ajax({
        type: 'POST',
        url: '$manyleave',
        dataType: 'json',
        data: {keylist: keys},
        success: function(data) {
            if (data.status === 'none') {
                alert('你没有选中任何人，无法操作。');
            } else if(data.status === 'mixed') {
                alert('选择的人有人不在队，无法操作。');
            } else if(data.status === 'error') {
                alert('系统错误，无法操作。');
            } else {
                alert(data.status);
            }
        },
    });
JS;

$jsonlick_manycancel = <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    $.ajax({
        type: 'POST',
        url: '$manycancel',
        dataType: 'json',
        data: {keylist: keys},
        success: function(data) {
            if (data.status === 'none') {
                alert('请先选择人员再操作。');
            } else if(data.status === 'mixed') {
                alert('选择的人有人未外出，无法操作。');
            } else if(data.status === 'error') {
                alert('系统错误，无法操作。');
            }
        },
    });
JS;

$toolbar = [
        '{export}',
        '{toggleData}',
        [
            'content'=>
                Html::button('<i class="fa fa-taxi fa-fw"></i>', [
                    'id' => 'btn-leave',
                    'class' => 'btn btn-success',
                    'title' => '批量外出',
                    'onclick' => $jsonlick_manyleave,
                ]) . ' ' .
                Html::button('<i class="fa fa-undo fa-fw"></i>', [
                    'id' => 'btn-cancel',
                    'class' => 'btn btn-warning',
                    'title' => '批量销假',
                    'onclick' => $jsonlick_manycancel,
                ]),
        ],
    ];

$panelAfterTemplate = <<<HTML
<div class="pull-right">
    <div class="btn-toolbar kv-grid-toolbar" role="toolbar">
        {toolbar}
    </div>    
</div>
{after}
<div class="clearfix"></div>
HTML;

echo GridView::widget([
    'id' => 'gridview',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'kartik\grid\SerialColumn'
        ],
        'name',
        /*
        [
            'attribute' => 'is_married',
            'filter'=> ['是'=>'是','否'=>'否'],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        ],
         */
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
            'filter'=> Lookup::FilterStatusForOut(),
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
            'template' => '{view}--{mixed}',
            'buttons' => [
                'mixed' => function ($url, $model, $key) {
                    if ($model->isHere) {
                        $label = '<span style="color:green" class="fa fa-taxi"></span>';
                        $url = Url::to(['out/leave', 'id' => $key]);
                        $options = [
                            'title' => '外出',
                            'data-pjax' => '0',
                        ];
                    } elseif ($model->isOut) {
                        $label = '<span style="color:orange" class="fa fa-undo"></span>';
                        $url = Url::to(['out/cancel', 'id' => $key]);
                        $options = [
                            'title' => '销假',
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
        [
            'class' => '\kartik\grid\CheckboxColumn'
        ],
    ],
    'toolbar' => $toolbar,
    'pjax' => true,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'floatHeaderOptions' => ['top' => 10],
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => $selfUnit->name,
        'before' => $selfUnit->infoAsString,
        'after' => '',
    ],
    'panelAfterTemplate' => $panelAfterTemplate,
    'exportConfig'=>$exportConfigForChinese,
]);
