<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HolidayOriginal */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Holiday Originals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-original-view">

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
            'name',
            'department',
            'grade',
            'hunfou',
            'ParentLocation',
            'WifeLocation',
            'towhere',
            'leavetime',
            'backtime',
            'waytime',
            'reason',
            'leaveOrback',
            'section',
            'backtimereal',
            'consumeDays',
            'totalDays',
            'xiujiaday',
            'otherday',
            'year',
        ],
    ]) ?>

</div>
