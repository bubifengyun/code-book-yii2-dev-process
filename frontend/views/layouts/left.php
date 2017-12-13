<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?php
$task_mode = Yii::$app->setting->get('task_mode');
if ($task_mode == 0) {?>
    <a href="#"><i class="circle text-success"></i>工作日</a>
<?php } elseif ($task_mode == 1) {?>
    <a href="#"><i style="color:yellow" class="circle"></i>周末休息</a>
<?php } elseif ($task_mode == 9) {?>
    <a style="color:red" href="#"><i class="flag fa-2x"></i><font size="5px">战备</font></a>
<?php } elseif ($task_mode > 1 and $task_mode < 9) {?>
    <a style="color:red" href="#"><i class="times-circle fa-2x"></i>该工作模式尚未启用</a>
<?php } else {?>
    <a style="color:red" href="#"><i class="times fa-2x"></i>该工作模式非法</a>
<?php }?>
<br>
            </div>
        </div>

<?php

    $header_menu = [
        'label' => '页面操作', 'options' => ['class' => 'header'],
    ];

    $menu_office_officer = [
    $header_menu,
    ['label' => '本月报表', 'icon' => 'moon-o', 'url' => ['/unit/month-officer-report']],
    ['label' => '本年报表', 'icon' => 'map-o', 'url' => ['/personinfo/year-officer-holiday-report']],
    [
        'label' => '党团人员列表',
        'icon' => 'heart-o',
        'url' => ['personinfo/party'],
    ],
    [
        'label' => '更多操作',
        'icon' => 'cogs',
        'url' => '#',
        'items' => [
            [
                'label' => '人员管理',
                'icon' => 'male',
                'url' => '#',
                'items' => [
                    ['label' => '批量导入Excel', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/upload'])],
                    ['label' => '批量导入CSV', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/upload-csv'])],
                    ['label' => '批量更改', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/bye']),],
                    ['label' => '单个录入', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/create'])],
                    ['label' => '批量删除', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/bye']),],
                ],
            ],
            ['label' => '家属来队', 'icon' => 'female', 'url' => '#',],
            [
                'label' => '路途天数',
                'icon' => 'train',
                'url' => '#',
                'items' => [
                    ['label' => '查询路途', 'icon' => 'eye', 'url' => ['districts/check'],],
                    ['label' => '设置路途', 'icon' => 'pencil', 'url' => '#',],
                ],
            ],
        ],
    ],
    ];
    $menu_office_solider = [
    $header_menu,
    ['label' => '设置周末', 'icon' => 'coffee', 'url' => ['/weekend/set']],
    ['label' => '本月报表', 'icon' => 'moon-o', 'url' => ['/unit/month-soldier-report']],
    ['label' => '临近归队', 'icon' => 'hourglass-half', 'url' => ['/holiday/unreturn-notify']],
    [
        'label' => '更多设置',
        'icon' => 'cogs',
        'url' => '#',
        'items' => [
            [
                'label' => '人员管理',
                'icon' => 'male',
                'url' => '#',
                'items' => [
                    ['label' => '批量导入Excel', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/upload'])],
                    ['label' => '批量导入CSV', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/upload-csv'])],
                    ['label' => '批量更改', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/bye']),],
                    ['label' => '单个录入', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/create'])],
                    ['label' => '批量删除', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['personinfo/bye']),],
                ],
            ],
            ['label' => '家属来队', 'icon' => 'female', 'url' => '#',],
            ['label' => '战斗级别管理', 'icon' => 'align-justify', 'url' => yii\helpers\Url::to(['mil-rank/index']),],
            ['label' => '在位状态管理', 'icon' => 'anchor', 'url' => yii\helpers\Url::to(['status/index']),],
            ['label' => '法定节假日管理', 'icon' => 'smile-o', 'url' => yii\helpers\Url::to(['law-holiday/index']),],
            [
                'label' => '单位管理',
                'icon' => 'sitemap',
                'url' => '#',
                'items' => [
                    ['label' => '批量导入Excel', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['unit/upload-excel'])],
                    ['label' => '批量导入CSV', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['unit/upload-csv'])],
                    ['label' => '修改编号', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['unit/update']),],
                    ['label' => '一般操作', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['unit/index']),],
                ],
            ],
            [
                'label' => '路途天数',
                'icon' => 'train',
                'url' => '#',
                'items' => [
                    ['label' => '查询路途', 'icon' => 'eye', 'url' => ['districts/check'],],
                    ['label' => '设置路途', 'icon' => 'pencil', 'url' => yii\helpers\Url::to(['districts/index']),],
                    ['label' => '省级管理', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['provinces/index']),],
                    ['label' => '市级管理', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['cities/index']),],
                    ['label' => '县级管理', 'icon' => 'circle-o', 'url' => yii\helpers\Url::to(['districts/index']),],
                ],
            ],
        ],
    ],
    ];

    $menu_junior = [
        $header_menu,
        ['label' => '人员基本信息', 'icon' => 'male', 'url' => yii\helpers\Url::to(['personinfo/index']),],
        ['label' => '本周工作安排', 'icon' => 'flag', 'url' => yii\helpers\Url::to(['unit/week-arrangement']),],
        ['label' => '周末回家安排', 'icon' => 'home', 'url' => yii\helpers\Url::to(['unit/weekend-home']),],
        [
            'label' => '党团人员列表',
            'icon' => 'heart-o',
            'url' => ['personinfo/party'],
        ],
        ['label' => '当前待晋职人员', 'icon' => 'rocket', 'url' => yii\helpers\Url::to(['personinfo/upgrade', 'kind' => 'job',]),],
        ['label' => '当前待晋级人员', 'icon' => 'plane', 'url' => yii\helpers\Url::to(['personinfo/upgrade', 'kind' => 'tech',]),],
        ['label' => '当前待晋衔人员', 'icon' => 'send-o', 'url' => yii\helpers\Url::to(['personinfo/upgrade', 'kind' => 'rank',]),],
        ['label' => '查询路途', 'icon' => 'train', 'url' => ['districts/check'],],
    ];

    $menu_leader = $menu_junior;

    $menu_sentry = [
        $header_menu,
    ];

    if (\Yii::$app->user->can('Junior')) {
        $menu = $menu_junior;
    } elseif (\Yii::$app->user->can('Leader')) {
        $menu = $menu_leader;
    } elseif (\Yii::$app->user->can('OfficeMilitaryOfficer')) {
        $menu = $menu_office_officer;
    } elseif (\Yii::$app->user->can('OfficeSoldier')) {
        $menu = $menu_office_solider;
    } elseif (\Yii::$app->user->can('Sentry')) {
        $menu = $menu_sentry;
    } else {
        $menu = [];
    }


?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget'=>"tree"],
                'items' => $menu,
            ]
        ) ?>

    </section>

</aside>
