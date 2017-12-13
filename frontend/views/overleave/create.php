<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Overleave */

$this->title = 'Create Overleave';
$this->params['breadcrumbs'][] = ['label' => 'Overleaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overleave-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
