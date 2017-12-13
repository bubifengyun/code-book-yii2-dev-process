<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Out */

$this->title = '外出请假:   ' . $name;
?>
<div class="out-update">

    <?= $this->render('_leaveform', [
        'model' => $model,
    ]) ?>

</div>
