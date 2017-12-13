<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LawHoliday */

$this->title = '录入法定节假日';
$this->params['breadcrumbs'][] = ['label' => '法定节假日', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-holiday-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
