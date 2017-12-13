<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReadyWar */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ready-war-view">

    <p>
        <?= Html::a('更改', ['set', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'begin_date',
            'end_date',
            /*
            'id',
            'name',
            'ratio_land_officer',
            'ratio_air_officer',
            'ratio_soldier',
            'ratio_officer',
             */
        ],
    ]) ?>

</div>
