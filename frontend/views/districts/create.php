<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Districts */

$this->title = '创建县';
$this->params['breadcrumbs'][] = ['label' => '全部县', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
