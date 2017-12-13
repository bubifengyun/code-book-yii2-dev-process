<?php

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use yii\helpers\Html;
use Endroid\QrCode\QrCode;
use common\components\WebRTCLocalIPWidget;
use common\models\PublicFunction;
use Plunar\Plunar;
use Plunar\PlunarException;
use Hisune\EchartsPHP\Doc\IDE\Series;
use bubifengyun\echarts\ECharts;



$chart = new ECharts($this, ['china.js']);
$chart->title = [
    'text' => "本单位人员分布",
    'left' => 'center',

];
$chart->visualMap->min = 0;
$chart->visualMap->max = 100;
$chart->visualMap->text = ['高', '低'];
$chart->visualMap->calculable = true;
$chart->visualMap->inRange->color = ['#C843C8', '#441744'];
$chart->tooltip->trigger = 'item';
$chart->tooltip->formatter = '{a}<br>{b}  {c}';
$series = new Series();
$series->name = '人员数目';
$series->type = 'map';
$series->map = 'china';
$series->data = [
    [
        'name' => '安徽',
        'value' => 100,
    ],
    [
        'name' => '北京',
        'value' => 50,
    ],
    [
        'name' => '四川',
        'value' => 80,
    ],
    [
        'name' => '湖北',
        'value' => 20,
    ],
    [
        'name' => '上海',
        'value' => 80,
    ],
];
$series->label->emphasis->show = false;
$series->label->emphasis->textStyle->color = '#fff';
$series->roam = true;
$series->scaleLimit->min = 1;
$series->scaleLimit->max = 5;
$series->itemStyle->normal->borderColor = '#bbb';
$series->itemStyle->normal->areaColor = '#F5F6FA';
$series->itemStyle->emphasis->areaColor = '#441744';
$chart->addSeries($series);
echo $chart->render('map', ['style' => 'height: 500px;']);
