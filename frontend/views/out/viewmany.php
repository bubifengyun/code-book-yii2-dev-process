<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Out */

$this->title = '外出情况:   ' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => 'Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="out-view">

    <p>
        <?= Html::a('销假', ['cancel', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('续假', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'owner.name',
            'time_leave',
            'time_come',
            'time_cancel',
            'tel',
            'note',
        ],
    ]) ?>

</div>
