<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Proportion */

$this->title = 'Create Proportion';
$this->params['breadcrumbs'][] = ['label' => 'Proportions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proportion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
