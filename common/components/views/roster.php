<?php

use common\models\Lookup;
use common\models\Status;

$style ='';
if ($isWarning) {
    $style = 'style="color:red"';
}

?>
<pre <?=$style?>>
    <h4 align="center"><?= Lookup::itemQuery(Status::tableName(), $status_id) ?><strong><?= $total ?></strong>人</h4>
<?php
