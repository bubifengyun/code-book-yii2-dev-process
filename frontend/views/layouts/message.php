<?php

use yii\helpers\Html;

?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>消息
<?php
$messageUnreadCount = Yii::$app->user->identity->messageUnreadCount;
if ($messageUnreadCount > 0) {
    if ($messageUnreadCount > 10) {
        $messageUnreadCount ='10+';
    }
?>
    <span class="label label-success"><?=$messageUnreadCount?></span>
<?php }?>
</a>
<ul class="dropdown-menu">
    <li class="header">您有<?=$messageUnreadCount?>条未读消息</li>
    <li>
        <ul class="menu">
<?php
$messagesUnreadLimited = Yii::$app->user->identity->messagesUnreadLimited;
foreach ($messagesUnreadLimited as $message) {?>
            <li>
            <a href=<?=yii\helpers\Url::to(['message/view', 'id'=> $message->id])?>>
                    <div class="pull-left">
                        <img src="<?= $directoryAsset ?>/img/<?= $message->sendUser->avatar == null ? "default.png" : $message->sendUser->avatar ?>" class="img-circle" alt="没有头像"/>
                    </div>
                    <h4>
                        <?=$message->sendUser->username?>
                        <small><i class="fa fa-clock-o"></i><?=\common\models\PublicFunction::timeBeforeFormate($message->create_time)?></small>
                    </h4>
                    <p><?=$message->content?></p>
                </a>
            </li>
<?php }?>
        </ul>
    </li>
    <li class="user-footer pull-left">
        <a href=<?=yii\helpers\Url::to(['message/view-all-messages'])?>>全部消息</a>
    </li>
    <li class="user-footer pull-right">
        <a href=<?=yii\helpers\Url::to(['message/write'])?>>开始写信</a>
    </li>
</ul>
