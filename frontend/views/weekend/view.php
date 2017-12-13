<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Weekend */

$this->title = '本周周末';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekend-view">

    <p>
        <?= Html::a('更改周末', ['set', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'begin_date',
            'end_date',
//            'default_begin_weekday',
//            'default_end_weekday',
        ],
    ]) ?>

</div>
