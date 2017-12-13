<?php
namespace common\components;

use yii\base\Widget;
use Yii;
use yii\helpers\Html;
use common\assets\Html5CamQrcodeAsset;

class Html5CamQrcodeWidget extends Widget
{
    public $id;
    public $width;
    public $height;
    public $callback;
    
    public function init()
    {
        parent::init();

        Html5CamQrcodeAsset::register($this->getView());
        if ($this->width == 0 || $this->width == null || $this->width == '') {
            $this->width = 800;
        }
        if ($this->height == 0 || $this->height == null || $this->height == '') {
            $this->height = 600;
        }
    }

    public function run()
    {
        $view = $this->getView();
        $view->registerJs("load();setoptions({width: '".$this->width."',height: '".$this->height."',".
            "callback: '".$this->callback."'});");

        return $this->render('html5camqrcode', [
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }
}
