<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Unit */

$this->title = '本周工作安排: ' . $model->name;
$this->params['breadcrumbs'][] = '设置';
?>
<div class="unit-update">

    <?= $this->render('_formweekarrange', [
        'model' => $model,
    ]) ?>

</div>

