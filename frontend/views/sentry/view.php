<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部岗哨', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentry-view">

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
            'user.username',
            'name',
            'host',
        ],
    ]) ?>

</div>
