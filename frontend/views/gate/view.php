<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'person_id',
            'leave_time',
            'leave_sentry',
            'leave_host',
            'come_time',
            'come_sentry',
            'come_host',
            'type',
            'has_completed',
        ],
    ]) ?>

</div>
