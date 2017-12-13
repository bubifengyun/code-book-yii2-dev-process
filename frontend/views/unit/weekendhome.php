<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\mpdf\Pdf;
use yii\helpers\Url;
use common\models\Lookup;
use common\models\Status;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '周末回家人员设置：' . $model->name;

$manyhome = Url::to(['/personinfo/many-home']);
$manycancelhome = Url::to(['/personinfo/many-cancelhome']);

$jsonlick_manyhome = <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    var isok = confirm('确认选择的人员回家？');
    if(!isok){
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '$manyhome',
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
$jsonlick_manycancelhome = <<<JS
    var keys = $('#gridview').yiiGridView('getSelectedRows');
    var isok = confirm('确认选择的人员撤销回家？');
    if(!isok){
        return false;
    }
    $.ajax({
        type: 'POST',
        url: '$manycancelhome',
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
$toolbar = [
    '{toggleData}',
    [
        'content' =>
        Html::button('<i class="fa fa-home fa-fw"></i>批量回家', [
            'id' => 'btn-home',
            'class' => 'btn btn-success',
            'title' => '批量回家',
            'onclick' => $jsonlick_manyhome,
        ]),
    ],
    [
        'content' =>
        Html::button('<i class="fa fa-undo fa-fw"></i>撤销回家', [
            'id' => 'btn-cancelhome',
            'class' => 'btn btn-danger',
            'title' => '撤销回家',
            'onclick' => $jsonlick_manycancelhome,
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

?>
<div class="Personinfo-index">

    <p>
        <?= Html::a('查看上报花名册', ['personinfo/roster', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'id' => 'gridview',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn'
            ],

            'name',
            'myhome',
            [
                'attribute'=>'status',
                'value' => function ($model) {
                    return Lookup::itemQuery(Status::tableName(), $model->status);
                },
                //下面语句在排序选择为空时，会把所有状态的人都拿出来。
                'filter'=> [Status::HERE => '在队', Status::WEEKENDHOME => '回家休息'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
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
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $model->name,
        ],
        'panelAfterTemplate' => $panelAfterTemplate,
    ]); ?>
</div>
