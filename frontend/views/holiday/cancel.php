<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */

$this->title = '销假: ' . $model->owner->name;
$this->params['breadcrumbs'][] = ['label' => 'Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-create">

    <?= $this->render('_cancelform', [
        'model' => $model,
    ]) ?>

</div>
