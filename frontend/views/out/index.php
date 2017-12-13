<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="out-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Out', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'time_leave',
            'time_come',
            'time_cancel',
            'tel',
            // 'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
