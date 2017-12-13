<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\tree\TreeView;
use kartik\mpdf\Pdf;
use common\models\Personinfo;
use common\models\PersoninfoSearch;
use common\models\Unit;
use common\models\Lookup;
use common\models\MilRank;
use common\models\Status;
use common\components\RosterWidget;
use yii\web\NotFoundHttpException;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */
/* @var $form yii\widgets\ActiveForm */

Pjax::begin();
// run every key=>value as variant in PHP.
extract($params);

$selfUnit = Unit::findOne($node->id);
$all_info = $selfUnit->getCurrentInformation();

$print_peron = function ($status_id, $person_kind, $suffix = '') use ($selfUnit, $all_info) {
    $i = 1;
    $column_number = 5;
    $count_j = 1;
    $count = $all_info[$status_id][$person_kind]['count'];
    if ($count == 0) {
        return false;
    }
    foreach ($all_info[$status_id][$person_kind]['query']->all() as $personinfo) {
        echo $personinfo->name . $suffix;
        if ($count_j < $count) {
            echo '、';
        }
        $count_j++;
        if ($i++ === $column_number && $count_j <= $count) {
            $i = 1;
            echo '<br>';
        }
    };

    return true;
};
?>

<table data-sort="sortDisabled" height="738" width="600" align="center">
    <tbody>
        <tr class="firstRow">
            <td colspan="2" rowspan="1" style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" align="center">
                单位<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="2" rowspan="1" valign="middle" align="center">
                <?= $selfUnit->name ?>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                值班老大<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                <?= $selfUnit->duty_officer ?><br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                总人数：<?= $all_info['total'] ?><br/>
            </td>
        </tr>
        <tr>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="2" rowspan="1" valign="middle" align="center">
                车马炮实有数<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                在位数及比例<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="1" valign="middle" width="80" align="center">
                <?php echo $all_info['count_officer'] . '/'
                    . $all_info['count_here_officer']. '/'
                    . $all_info['ratio_officer'] ?>%<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                将士象实有数<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                在位数及比例<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="80" align="center">
                <?php echo $all_info['count_soldier'] . '/'
                    . $all_info['count_here_soldier']. '/'
                    . $all_info['ratio_soldier'] ?>%<br/>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="10" valign="middle" width="80" align="center">
                <p>
                    在位人数
                </p>
                <p>
                    （<?= $all_info['count_here'] ?> 人）
                </p>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="2" valign="middle" width="40" align="center">
                <p>
                    现有
                </p>
                <p>
                    人数
                </p>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['count_current_here_officer'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
<?php
$status_id_string = Yii::$app->setting->get('status_current_here');
$status_ids = ArrayHelper::map(Status::find()
    ->where(['local' => true])->all(), 'id', 'id');

foreach ($status_ids as $status_id) {
    if ($print_peron($status_id, 'officer')) {
        echo '<br/>';
    }
}

?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['count_current_here_soldier'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
<?php
foreach ($status_ids as $status_id) {
    if ($print_peron($status_id, 'soldier')) {
        echo '<br/>';
    }
}
?>
            </td>
        </tr>
        <tr>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="2" valign="middle" width="undefined" align="center">
                疗养<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['9']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(9,'officer');?><br/>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['9']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(9,'soldier');?><br/>
            </td>
        </tr>
        <tr>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="2" valign="middle" width="undefined" align="center">
                出差<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['5']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(5,'officer');?><br/>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['5']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(5,'soldier');?><br/>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="2" colspan="1" valign="middle" width="undefined" align="center">
                <p>
                    学习
                </p>
                <p>
                    培训
                </p>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['8']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(8,'officer');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['8']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(8,'soldier');?>
            </td>
        </tr>
        <tr>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="2" colspan="1" valign="middle" width="undefined" align="center">
                住院<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['6']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(6, 'officer');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['6']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(6, 'soldier');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="6" colspan="1" valign="middle" width="undefined" align="center">
                <p>
                    不在位人数
                </p>
                <p>
                    （<?= $all_info['count_unhere'] ?> 人）
                </p>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="2" colspan="1" valign="middle" width="undefined" align="center">
                休假<br/>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['10']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(10, 'officer');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['10']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(10, 'soldier');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="2" colspan="1" valign="middle" width="undefined" align="center">
                事假
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['11']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(11, 'officer');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="1" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['11']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" colspan="4" valign="top" align="left">
                <?php $print_peron(11, 'soldier');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="1" rowspan="2" valign="middle" width="undefined" align="center">
                <p>
                    回家
                </p>
                <p>
                    休息
                </p>
            </td>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                车马炮（<?=$all_info['13']['officer']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(13, 'officer');?>
            </td>
        </tr>
        <tr>
            <td style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                将士象（<?=$all_info['13']['soldier']['count'] ?>人）<br/>
            </td>
            <td style="border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" colspan="4" rowspan="1" valign="top" align="left">
                <?php $print_peron(13, 'soldier');?>
            </td>
        </tr>
        <tr class="firstRow">
            <td colspan="1" rowspan="1" style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" valign="middle" width="undefined" align="center">
                备注<br/>
            </td>
            <td colspan="6" style="word-break: break-all; border-width: 2px; border-style: solid; border-color: rgb(221, 221, 221);" rowspan="1" valign="top" align="null">
                <p>
                    1.
                </p>
                <p>
                    2.
                </p>
                <p>
                    3.
                </p>
                <p>
                    4.<br/>
                </p>
            </td>
        </tr>
    </tbody>
</table>
