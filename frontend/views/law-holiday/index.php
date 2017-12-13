<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LawHolidaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '法定节假日';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-holiday-index">

    <p>
        <?= Html::a('录入法定节假日', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
