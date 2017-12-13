<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReadyWarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ready Wars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ready-war-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ready War', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'begin_date',
            'end_date',
            'ratio_land_officer',
            // 'ratio_air_officer',
            // 'ratio_soldier',
            // 'ratio_officer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
