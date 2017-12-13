<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Districts */

$this->title = '修改县: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部县', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="districts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
