<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */

$this->title = 'Update Statistics Holiday: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statistics Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="statistics-holiday-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
