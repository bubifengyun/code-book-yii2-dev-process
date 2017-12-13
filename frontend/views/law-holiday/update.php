<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LawHoliday */

$this->title = '更新法定节假日' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '法定节假日', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="law-holiday-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
