<?php

namespace common\models;

use common\models\Holiday;

class SerialColumnForGBK extends \kartik\grid\SerialColumn
{
    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $other_count = Holiday::find()
            ->where([
                'which_year' => date('Y'),
                'report_month' => date('m'),
            ])
            ->joinWith('owner')
            ->where([
                '<', 'unit_code',
                $model->owner->unit->upParent->id
            ])
            ->andWhere([
                '>=', 'mil_rank',
                MilRank::LOWESTMOFFICER
            ])
            ->count();
        return $index - $other_count + 1;
    }
}
