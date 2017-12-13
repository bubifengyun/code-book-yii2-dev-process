<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Status;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */

$this->title = $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => $model->owner->name, 'url' => ['personinfo/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->h_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->h_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
  //          'h_id',
            'owner.name',
            'date_leave',
            'which_year',
            'date_come',
            'date_cancel',
 //           'boss_id',
            'where_leave',
            'tel',
            [
                'attribute' => 'kind',
                'value' => Lookup::itemQuery(
                    Status::tableName(),
                    $model->kind
                ),
            ],
//            'paper',
        ],
    ]) ?>

</div>
