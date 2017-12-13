<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = '创建人员';
$this->params['breadcrumbs'][] = ['label' => '所有人员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
