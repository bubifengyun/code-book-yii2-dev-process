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

    <p><h2>我关注的</h2></p>

    <div class="container">
        <div class="row">
            <?php if (count($friends)>0) :?>
                <?php foreach ($friends as $v) : ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->username?>" class="img-circle tx" src="<?php if ($v->avatar) :
?><?=$v->avatar?><?
else :
?>/avatar/avatar.jpg<?
endif?>" alt=""/>
                        <p class="text-info username"><?=$v->username?></p>
                        <p><a href=<?=Url::to(['/user/nofollow','fid'=>$v->id])?> class="btn btn-primary btn-sm btn-danger">取消关注</a></p>
                    </div>
                <? endforeach?>
            <?else :?>
               <p>没有关注任何人！</p>
            <?endif?>
        </div>
    </div>
    
</div>
</body>
