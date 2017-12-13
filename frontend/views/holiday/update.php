<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */

$this->title = '修改假单:' . ' ' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => 'Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->h_id, 'url' => ['view', 'id' => $model->h_id]];
$this->params['breadcrumbs'][] = '修改假单';
?>
<div class="holiday-update">

    <?= $this->render('_leaveform', [
        'model' => $model,
    ]) ?>

</div>
