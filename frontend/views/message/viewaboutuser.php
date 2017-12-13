<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\Message;

/* @var $this yii\web\View */
/* @var $allMessages common\models\Message's array */
/* @var $myname string */
/* @var $othername string */

$this->title = $othername . ' 相关消息';
$this->params['breadcrumbs'][] = ['label' => '消息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

<?php foreach ($allMessages as $model) {?>
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
<?php }?>

    <div class="reply">

        <?php if ($added) {?>
        <div class="title">
        
            <div class="author">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= $replyMessage->create_time."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($replyMessage->sendUser->username) ; ?></em>
            </div>
        </div>
        <div>
            <?=nl2br($model->content) ?>
        </div>
            <?php }?>  
    
        <h3>给他写信</h3>
            <?php
            $replyMessage = new Message();
            echo $this->render('_reply', [
                    'id'=>$model->id,
                'replyMessage'=>$replyMessage,
            ]); ?>
    </div><!-- reply -->            

</div>

