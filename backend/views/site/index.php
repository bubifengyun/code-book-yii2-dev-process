<?php

use abhimanyu\systemInfo\SystemInfo;

/* @var $this yii\web\View */

function convert($size)
{
    $unit=['b','kb','mb','gb','tb','pb'];
    return @round($size/pow(1024, ($i=floor(log($size, 1024)))), 2).' '.$unit[$i];

}

$this->title = '人员动态管理后台';
?>
<div class="site-index">
<h2>当前时间</h2>
<?=date('Y-m-d H:i:s')?>
<h2>CPU利用率</h2>
<?php
$cpu_usages = sys_getloadavg();
echo '01分钟内：'.$cpu_usages[0] . '%<br>';
echo '05分钟内：'.$cpu_usages[1] . '%<br>';
echo '15分钟内：'.$cpu_usages[2] . '%<br>';
?>
<h2>内存利用率</h2>
<?=convert(memory_get_usage())?>
<h2>运行时间</h2>
启动时间：<?=shell_exec("uptime -s")?><br>
已经运行：<?=shell_exec("uptime -p")?><br>
</div>
<?php

// Get the class to work with the current operating system
$system = SystemInfo::getInfo();

// Captain Obvious was here
echo $system::getHostname();

 echo $system::getOS();
 echo $system::getKernelVersion();
 echo $system::getHostname();
 echo $system::getCpuModel();
 echo $system::getCpuVendor();
 echo $system::getCpuFreq();
 echo $system::getCpuArchitecture();
 echo $system::getCpuCores();
 echo $system::getLoad();
 echo $system::getUpTime();
 echo $system::getPhpVersion();
 echo $system::getServerName();
 echo $system::getServerProtocol();
 echo $system::getServerSoftware();
 echo $system::getTotalMemory();

