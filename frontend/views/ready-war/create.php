<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadyWar */

$this->title = 'Create Ready War';
$this->params['breadcrumbs'][] = ['label' => 'Ready Wars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ready-war-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
