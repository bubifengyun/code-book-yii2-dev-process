<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */

$this->title = '创建地级市';
$this->params['breadcrumbs'][] = ['label' => '全部地级市', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
