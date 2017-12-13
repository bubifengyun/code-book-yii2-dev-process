<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statistics Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-holiday-view">

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
            'day_total',
            'day_left',
            'day_left_lastyear',
            'day_lend_nextyear',
            'day_tohere',
            'boss_id',
            'current_h_id',
            'tel',
            'day_add',
            'day_add_is_nextyear',
            'day_add_ps',
            'day_path',
        ],
    ]) ?>

</div>
