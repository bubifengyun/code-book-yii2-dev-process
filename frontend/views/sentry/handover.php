<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */

$this->title = '岗位交接:' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部岗哨', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '岗位交接';
?>
<div class="sentry-update">

    <?= $this->render('_form_handover', [
        'model' => $model,
    ]) ?>

</div>
