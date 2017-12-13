    <?= $form->field($node, 'is_limited')->dropDownList([ '1' => '是', '0' => '否', ], ['prompt' => '']) ?>
    <?= $form->field($node, 'base_level')->dropDownList([ '0' => '基层单位', '1' => '中层单位', '2' => '整个单位', ], ['prompt' => '']) ?>
    <?= $form->field($node, 'type')->dropDownList([
        '0' => '战备人员在位不受比例限制',
        '1' => '平时人员在位受比例限制',
        '2' => '平时人员在位不受比例限制',
        '3' => '战备人员在位受比例限制',
    ], ['prompt' => '']) ?>
