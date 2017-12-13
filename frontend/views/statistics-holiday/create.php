<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */

$this->title = 'Create Statistics Holiday';
$this->params['breadcrumbs'][] = ['label' => 'Statistics Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-holiday-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
