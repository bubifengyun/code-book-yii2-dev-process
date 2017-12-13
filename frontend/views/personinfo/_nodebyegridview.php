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
$filename = $selfUnit->name.'啥玩意啊情况';
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

$units = Unit::find()->addOrderBy('root, lft')->all();

$searchModel = new PersoninfoSearch();
$searchModel->unit_code = $selfAndChildrenID;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

$manybye = Url::to(['/personinfo/many-bye']);
$manyassign = Url::to(['/personinfo/many-assign']);

$jsonlick_manybye= <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    var isok = confirm('确认删除选择的人员？');
    if(!isok){
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '$manybye',
        dataType: 'json',
        data: {keylist: keys},
        success: function(data) {
            if (data.status === 'none') {
                alert('你没有选中任何人，无法操作。');
            } else if(data.status === 'error') {
                alert('系统错误，无法操作。');
            } else {
                alert(data.status);
            }
        },
    });
JS;

$jsonlick_manyassign = <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    var selected_unit = $('#unit_assign option:selected').val();

    $.ajax({
        type: 'POST',
        url: '$manyassign',
        dataType: 'json',
        data: {'keylist':keys,'unit':selected_unit},
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
    [
        'content' =>
        Html::button('<i class="fa fa-trash fa-fw"></i>批量删除', [
            'id' => 'btn-leave',
            'class' => 'btn btn-danger',
            'title' => '批量删除',
            'onclick' => $jsonlick_manybye,
        ]),
    ],
    [
        'content'=>
        Html::button('<i class="fa fa-sitemap fa-fw"></i>批量分配至', [
            'id' => 'btn-assign',
            'class' => 'btn btn-success',
            'title' => '批量分配',
            'onclick' => $jsonlick_manyassign,
        ]) . ' ' .
        Html::dropDownList(
            'unit_assign',
            null,
            ArrayHelper::map($units, 'id', 'name'),
            ['id' => 'unit_assign']
        ),
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
        'birthdate',
        'armydate',
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
    ],
//    'panelAfterTemplate' => $panelAfterTemplate,
    'exportConfig'=>$exportConfigForChinese,
]);
