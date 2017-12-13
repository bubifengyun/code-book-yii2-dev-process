<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Provinces */

$this->title = '创建省份';
$this->params['breadcrumbs'][] = ['label' => '全部省份', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provinces-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
