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
                <a href="#">
                    <div class="pull-left">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                            alt="User Image"/>
                    </div>
                    <h4>
                        <small><i class="fa fa-clock-o"></i><?=$message->create_time?></small>
                    </h4>
                    <p><?=$message->content?></p>
                </a>
            </li>
<?php }?>
        </ul>
    </li>
    <li class="footer"><a href="#">查看全部消息</a></li>
</ul>
