<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */

$this->title = '设置假期总天数和路途:' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => $model->owner->name, 'url' => ['personinfo/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-holiday-update">

    <?= $this->render('_form_path_total', [
        'model' => $model,
    ]) ?>

</div>
