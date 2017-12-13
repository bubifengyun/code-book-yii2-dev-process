<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Holiday Originals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holiday-original-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Holiday Original', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'department',
            'grade',
            'hunfou',
            // 'ParentLocation',
            // 'WifeLocation',
            // 'towhere',
            // 'leavetime',
            // 'backtime',
            // 'waytime',
            // 'reason',
            // 'leaveOrback',
            // 'section',
            // 'backtimereal',
            // 'consumeDays',
            // 'totalDays',
            // 'xiujiaday',
            // 'otherday',
            // 'year',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
