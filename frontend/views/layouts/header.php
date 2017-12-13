<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Lookup;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">学习</span><span class="logo-lg">' . Yii::$app->setting->get('site_name') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href=<?=yii\helpers\Url::home()?> data-pjax="0"><i class="fa fa-home"></i>首页</a></li>
<?php
if (\Yii::$app->user->can('Sentry')) { ?>
                <li><a href=<?=yii\helpers\Url::to(['sentry/handover'])?> data-pjax="0"><i class="fa fa-paw"></i>值勤</a></li>
<?php
}
if (\Yii::$app->user->can('Junior')) { ?>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/out'])?> data-pjax="0"><i class="fa fa-taxi"></i>外出</a></li>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/roster'])?> data-pjax="0"><i class="fa fa-users"></i>花名册</a></li>
<?php
}
if (\Yii::$app->user->can('OfficeMilitaryOfficer')) {
?>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/holiday'])?> data-pjax="0"><i class="fa fa-plane"></i>休假</a></li>
<?php }
if (\Yii::$app->user->can('OfficeSoldier')) {
?>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/holiday'])?> data-pjax="0"><i class="fa fa-plane"></i>休假</a></li>
                <li><a href=<?=yii\helpers\Url::to(['personinfo/roster'])?> data-pjax="0"><i class="fa fa-users"></i>花名册</a></li>
<?php }?>
                <li><a href=<?=yii\helpers\Url::to(['/post/create'])?> data-pjax="0"><i class="fa fa-pencil"></i>写作</a></li>
                <li class="dropdown messages-menu">
                    <?= $this->render(
                        'message',
                        ['directoryAsset' => $directoryAsset]
                    )?>
                </li>
                <li class="dropdown help-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-question-circle"></i>帮助
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href=<?=yii\helpers\Url::to(['/post/home'])?> data-pjax="0"><i class="fa fa-newspaper-o"></i>规章制度</a></li>
                        <li><a href=<?=yii\helpers\Url::to(['/site/contact'])?> data-pjax="0"><i class="fa fa-commenting"></i>反馈意见</a></li>
                        <li><a href=<?=yii\helpers\Url::to(['/message/write'])?> data-pjax="0"><i class="fa fa-check"></i>发布请示</a></li>
<?php
if (!\Yii::$app->user->can('Junior')) { ?>
                        <li><a href=<?=yii\helpers\Url::to(['/weekend/set', 'id'=>'40'])?> data-pjax="0"><i class="fa fa-coffee"></i>更改周末</a></li>
                        <li><a href=<?=yii\helpers\Url::to(['/ready-war/set', 'id'=>'40'])?> data-pjax="0" style="color:red"><i class="fa fa-flag"></i>进入战备</a></li>
<?php }?>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/<?= \Yii::$app->user->identity->avatar == null ? "default.png" : \Yii::$app->user->identity->avatar ?>" class="user-image" alt="没有头像"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/<?= \Yii::$app->user->identity->avatar == null ? "default.png" : \Yii::$app->user->identity->avatar ?>" class="img-circle" alt="没有头像"/>
                            <p>
                                <?= Html::a(
                                    '修改头像',
                                    ['/user/change-avatar'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="<?=Url::to(['/user/update'])?>">改IP</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?=Url::to(['/site/modify-password'])?>">改密码</a>
                            </div>
                            <div class="col-xs-4 text-center">
                            <a href=<?=Url::to(['/user/index'])?>>朋友圈</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    '个人简介',
                                    ['/user/view', 'id' => Yii::$app->user->id],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
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
