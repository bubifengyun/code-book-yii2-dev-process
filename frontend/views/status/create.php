<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Status */

$this->title = '新增状态';
$this->params['breadcrumbs'][] = ['label' => '状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
