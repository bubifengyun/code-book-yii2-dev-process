<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HolidaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Holidays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Holiday', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'h_id',
            'id',
            'date_leave',
            'which_year',
            'date_come',
            // 'date_cancel',
            // 'boss_id',
            // 'where_leave',
            // 'tel',
            // 'kind',
            // 'paper',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
