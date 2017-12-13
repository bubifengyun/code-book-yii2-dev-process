<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-view">

    <?= kartik\detail\DetailView::widget([
        'model' => $model->statisticsHoliday,
        'condensed'=>true,
        'hover'=>true,
        'panel'=>[
            'heading' => Html::a($model->name, Url::to(['view', 'id'=>$model->id])) .'：'
            . Html::tag('span', $model->statusName, ['style' => ['color' => 'red']]) . '，'
            . $model->unitName,
            'type'=>kartik\detail\DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'day_total',
            'day_left',
            'day_add',
            'day_add_ps',
            'day_path',
        ],
    ]) ?>

</div>

<div class="personinfo-view">

<?php
    var_dump($model->thisYearHolidays);
?>

<?php /*

    <?= yii\widgets\ListView::widget([
        'dataProvider' => $model->thisYearHolidays,
        'itemView'=>'null',
    ])?>
 */ ?>

</div>
