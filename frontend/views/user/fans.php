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

    <p><h2>我的粉丝</h2></p>
    <div class="container">
        <div class="row">
            <?php if (count($fans)>0) :?>
                <?php foreach ($fans as $v) : ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->username?>" class="img-circle tx" src="<?php if ($v->avatar) :
?><?=$v->avatar?><?
else :
?>/avatar/avatar.jpg<?
endif?>" alt=""/>


                            <?php if (in_array($v->id, $friendIDs)) :?>
                                <p class="text-success username" href="javascript:void(0)"><span title="我们互相关注了！" class="glyphicon glyphicon-ok-circle"></span> <?=$v->username?></p>
                            <?else :?>
                                <p class="text-danger username"  href="javascript:void(0)" ><span title="还未关注他哦！" class="glyphicon glyphicon-remove-circle"></span> <?=$v->username?></p>
                            <?endif?>

                    </div>
                <? endforeach?>
                <?else :?>
                <p>好可怜，一个粉丝都没有！</p>
            <?endif?>
        </div>
    </div>
    
</div>
</body>
