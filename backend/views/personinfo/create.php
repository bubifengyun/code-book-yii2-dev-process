<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = 'Create Personinfo';
$this->params['breadcrumbs'][] = ['label' => 'Personinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
