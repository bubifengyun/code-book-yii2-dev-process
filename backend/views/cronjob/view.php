<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<h1>cron-job/view</h1>

<p>
    <p>
        <?= Html::a('更改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <code><?= $model->line ?></code>
</p>
