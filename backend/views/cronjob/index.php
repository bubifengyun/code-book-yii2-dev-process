<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CronjobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cronjobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cronjob-index">

    <p>
        <?= Html::a('新建命令', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'line',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <p>
<h3>实际运行中的命令</h3>

<?php
exec('crontab -l', $outputLines, $exitCode);
if ($exitCode === 0) {
    var_dump($outputLines);
} else {
    echo '执行错误！';
}
?>
    </p>

</div>
