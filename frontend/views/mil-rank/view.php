<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MilRank */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '军衔', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mil-rank-view">

    <p>
        <?= Html::a('更改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除该军衔？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
