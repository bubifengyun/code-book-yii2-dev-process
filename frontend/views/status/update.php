<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Status */

$this->title = '更新状态: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
