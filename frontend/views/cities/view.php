<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部地级市', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-view">

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
                'attribute' => 'province.name',
                'label' => '省份',
            ],
        ],
    ]) ?>

</div>
