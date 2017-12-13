<?php
use yii\helpers\Html;
use common\models\Lookup;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">飞狼</span><span class="logo-lg">' . Yii::$app->setting->get('site_name') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href=<?=yii\helpers\Url::home()?> data-pjax="0"><i class="fa fa-home"></i>首页</a></li>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/out'])?> data-pjax="0"><i class="fa fa-bus"></i>外出</a></li>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/index'])?> data-pjax="0"><i class="fa fa-users"></i>花名册</a></li>
                <li class="dropdown messages-menu">
                    <?php require('message.php');?>
                </li>
                <li class="dropdown help-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-question-circle"></i>帮助
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?=yii\helpers\Url::to(['/post/index'])?> data-pjax="0"><i class="fa fa-newspaper-o"></i>规章制度</a></li>
                        <li><a href=<?=yii\helpers\Url::to(['/site/contact'])?> data-pjax="0"><i class="fa fa-commenting"></i>联系我们</a></li>
                        <li><a href=<?=yii\helpers\Url::to(['/site/contact'])?> data-pjax="0"><i class="fa fa-check"></i>发布请示</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?=Yii::$app->user->identity->username ?>
                                <small><?=Lookup::item('Unit', Yii::$app->user->identity->see_unit)?>你好</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">粉丝</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">好友</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人简介</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
