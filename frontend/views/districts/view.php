<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Districts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部县', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            [
                'attribute' => 'city.name',
                'label' => '地级市',
            ],
            [
                'attribute' => 'province.name',
                'label' => '省份',
            ],
            'day_path',
        ],
    ]) ?>

</div>
