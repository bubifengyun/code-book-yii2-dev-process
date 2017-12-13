<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
?>

<!doctype html>
<head>
    <script>
        $(function(){
            ckinfo();
            //检查信息框
             function ckinfo(){
                var len=$(".text").length;
                if(len){
                    fadeInfo();
                }
            }

            //消息消失动画
            function fadeInfo(){
                setTimeout(function(){
                    //alert('消息框即将消失！');
                    $(".text").fadeOut(800);
                },1000)
            }

        })
    </script>
</head>
<body>
<div class="main">

   <h1>推荐朋友</h1>
    <div class="container">
        <div class="row">
            <?php if (count($users)>0) :?>
                <?php foreach ($users as $v) : ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->username?>" class="img-circle tx" src="<?php if ($v->avatar) :
?><?=$v->avatar?><?php
else :
?>/avatar/avatar.jpg<?php
endif?>" alt=""/>
                        <p class="text-info username"><?=$v->username?></p>
                        <p><a href=<?=Url::to(['/user/follow','fid'=>$v->id])?> class="btn btn-primary btn-sm btn-success">添加关注</a></p>
                    </div>
                <?php endforeach?>
            <?php endif?>
        </div>
    </div>

    <p><h2>我的粉丝</h2></p>
    <div class="container">
        <div class="row">
            <?php if (count($fans)>0) :?>
                <?php foreach ($fans as $v) : ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->username?>" class="img-circle tx" src="<?php if ($v->avatar) :
?><?=$v->avatar?><?php
else :
?>/avatar/avatar.jpg<?php
endif?>" alt=""/>


                            <?php if (in_array($v->id, $friendIDs)) :?>
                                <p class="text-success username" href="javascript:void(0)"><span title="我们互相关注了！" class="glyphicon glyphicon-ok-circle"></span> <?=$v->username?></p>
                            <?php else :?>
                                <p class="text-danger username"  href="javascript:void(0)" ><span title="还未关注他哦！" class="glyphicon glyphicon-remove-circle"></span> <?=$v->username?></p>
                            <?php endif?>

                    </div>
                <?php endforeach?>
                <?php else :?>
                <p>好可怜，一个粉丝都没有！</p>
            <?php endif?>
        </div>
    </div>

    <p><h2>我的关注</h2></p>

    <div class="container">
        <div class="row">
            <?php if (count($friends)>0) :?>
                <?php foreach ($friends as $v) : ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->username?>" class="img-circle tx" src="<?php if ($v->avatar) :
?><?=$v->avatar?><?php
else :
?>/avatar/avatar.jpg<?php
endif?>" alt=""/>
                        <p class="text-info username"><?=$v->username?></p>
                        <p><a href=<?=Url::to(['/user/nofollow','fid'=>$v->id])?> class="btn btn-primary btn-sm btn-danger">取消关注</a></p>
                    </div>
                <?php endforeach?>
            <?php else :?>
               <p>没有关注任何人！</p>
            <?php endif?>
        </div>
    </div>
    
</div>
</body>
