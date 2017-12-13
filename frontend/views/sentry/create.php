<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */

$this->title = '创建岗哨';
$this->params['breadcrumbs'][] = ['label' => '全部岗哨', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentry-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
