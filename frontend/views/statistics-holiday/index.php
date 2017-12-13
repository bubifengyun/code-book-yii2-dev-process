<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statistics Holidays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-holiday-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Statistics Holiday', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'day_total',
            'day_left',
            'day_left_lastyear',
            'day_lend_nextyear',
            // 'day_tohere',
            // 'boss_id',
            // 'current_h_id',
            // 'tel',
            // 'day_add',
            // 'day_add_is_nextyear',
            // 'day_add_ps',
            // 'day_path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
