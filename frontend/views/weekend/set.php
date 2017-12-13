<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Weekend */

$this->title = '更改周末';
$this->params['breadcrumbs'][] = '更改';
?>
<div class="weekend-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
