<?php

use bupy7\gridifyview\GridifyView;

echo GridifyView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_avatar',
    'onlyItems' => isset($onlyItems) ? $onlyItems : false,
    'pluginOptions' => [
        'url' => ['change-avatar'],
        'srcNode' => '> div',
        'resizable' => true,
        'width' => '250px',
        'maxWidth' => '350px',
        'margin' => '20px',
    ],
]);
