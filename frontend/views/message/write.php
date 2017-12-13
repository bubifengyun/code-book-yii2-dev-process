<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = '写信';
$this->params['breadcrumbs'][] = ['label' => '消息', 'url' => ['view-all-messages']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
