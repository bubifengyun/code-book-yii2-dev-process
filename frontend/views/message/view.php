<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use common\models\Message;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = $model->sendUser->username . ' 发来的消息';
$this->params['breadcrumbs'][] = ['label' => '消息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <p>
        <?= Html::a('与'.$model->sendUser->username.'的所有消息', ['view-about-user', 'id'=> $model->sendUser->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('删除该消息', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="message">
        <div class="title">
        
            <div class="author">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= $model->create_time."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($model->sendUser->username) ; ?></em>
            </div>
        </div>
        <div>
            <?=nl2br($model->content) ?>
        </div>
    </div>

    <div class="reply">

        <?php if ($added) {?>
        <div class="title">
        
            <div class="author">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= $replyMessage->create_time."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($replyMessage->sendUser->username) ; ?></em>
            </div>
        </div>
                <br>
        <div class="content">

        <?= HtmlPurifier::process($replyMessage->content) ?> 
        </div>
            <?php }?>  
    
        <h3>回复该消息</h3>
            <?php
            $replyMessage = new Message();
            echo $this->render('_reply', [
                    'id'=>$model->id,
                'replyMessage'=>$replyMessage,
            ]); ?>
    </div><!-- reply -->            

</div>

