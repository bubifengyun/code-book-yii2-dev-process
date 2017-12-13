<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MilRank */

$this->title = '更改军衔: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '军衔', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mil-rank-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
