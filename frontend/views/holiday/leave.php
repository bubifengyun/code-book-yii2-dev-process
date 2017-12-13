<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */

$this->title = '休假: ' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => $model->owner->name, 'url' => ['personinfo/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?= Html::a('设置假期天数', ['statistics-holiday/update-day-path-total', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('增加假期天数', ['statistics-holiday/update-day-add', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

<div class="holiday-create">

    <?= $this->render('_leaveform', [
        'model' => $model,
    ]) ?>

</div>
