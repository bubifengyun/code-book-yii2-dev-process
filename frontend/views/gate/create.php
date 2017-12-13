<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gate */

$this->title = 'Create Gate';
$this->params['breadcrumbs'][] = ['label' => 'Gates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
