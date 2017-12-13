<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\tree\TreeView;
use kartik\mpdf\Pdf;
use common\models\Lookup;
use common\models\Status;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '门岗记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gate-index">

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'owner.name',
            'owner.unitName',
            'leave_time',
            'leaveSentry.name',
            'leave_host',
            'come_time',
            'comeSentry.name',
            'come_host',
            [
                'attribute'=>'type',
                'value' => function ($model) {
                    return Lookup::itemQuery(Status::tableName(), $model->type);
                },
            ],
            [
                'attribute'=>'has_completed',
                'value' => function ($model) {
                    if ($model->has_completed) {
                        return '是';
                    } else {
                        return '否';
                    }
                },
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
