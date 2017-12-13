<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */

$this->title = '加减假期:' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => $model->owner->name, 'url' => ['personinfo/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-holiday-update">

    <?= $this->render('_form_add', [
        'model' => $model,
        'addHoliday' => $addHoliday,
    ]) ?>

</div>
