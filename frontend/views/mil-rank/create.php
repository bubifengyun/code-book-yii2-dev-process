<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MilRank */

$this->title = '新建军衔';
$this->params['breadcrumbs'][] = ['label' => '军衔', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mil-rank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
