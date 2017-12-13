<?php
namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\Status;

class RosterWidget extends Widget
{
    const COLUMNNUMBER = 7;
    public $isWarning;
    public $isShowOut;
    public $isShowHoliday;
    public $queryPersoninfo;
    public $status_id;
    public $column_number;
    
    public function init()
    {
        parent::init();
        if ($this->isShowOut === null) {
            if ($this->status_id === Status::OUT) {
                $this->isShowOut = true;
            } else {
                $this->isShowOut = false;
            }
        }
        if ($this->isShowHoliday === null) {
            if ($this->status_id > Status::OVERLEAVE) {
                $this->isShowHoliday = true;
            } else {
                $this->isShowHoliday = false;
            }
        }
        if ($this->isWarning === null) {
            if ($this->status_id === Status::OVERLEAVE) {
                $this->isWarning = true;
            } else {
                $this->isWarning = false;
            }
        }
        if ($this->column_number === null) {
            $this->column_number = self::COLUMNNUMBER;
        } elseif ($this->column_number == 0) {
            $this->column_number = self::COLUMNNUMBER;
        }
        if ($this->queryPersoninfo === null) {
            throw new NotFoundHttpException('没有选中要显示的人员类别！');
        }
    }

    public function run()
    {
        $total = $this->queryPersoninfo['total'];
        $count_military_officers = $this->queryPersoninfo['military_officer']['count'];
        $count_soldiers = $this->queryPersoninfo['soldier']['count'];
        $query_military_officers = $this->queryPersoninfo['military_officer']['query'];
        $query_soldiers = $this->queryPersoninfo['soldier']['query'];

        return $this->render('roster', [
            'status_id' => $this->status_id,
            'query_military_officers' => $query_military_officers,
            'query_soldiers' => $query_soldiers,
            'total' => $total,
            'count_military_officers' => $count_military_officers,
            'count_soldiers' => $count_soldiers,
            'column_number' => $this->column_number,
            'isShowOut' => $this->isShowOut,
            'isShowHoliday' => $this->isShowHoliday,
            'isWarning' => $this->isWarning,
        ]);
    }
}
