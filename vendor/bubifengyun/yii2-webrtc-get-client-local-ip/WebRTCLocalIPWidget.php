<?php

namespace bubifengyun\WebrtcGetClientLocalIp;

use yii\widgets\InputWidget;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class WebRTCLocalIPWidget extends InputWidget
{
    public $hidden = true;
    public $attributes;
    public $id = 'webrtclocalip';
    public $name = 'webrtclocalip';
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $view = $this->getView();
        $this->attributes['id'] = $this->id;
        if ($this->hasModel()) {
            if ($this->hidden) {
                $input = Html::activeHiddenInput($this->model, $this->attribute, $this->attributes);
            } else {
                $input = Html::activeTextInput($this->model, $this->attribute, $this->attributes);
            }
        } else {
            if ($this->hidden) {
                $input = Html::hiddenInput($this->name, '', $this->attributes);
            } else {
                $input = Html::textInput($this->name, '', $this->attributes);
            }
        }
        echo $input;
        WebRTCLocalIPAsset::register($view);
        $view->registerJs("setoptions({id: '" . $this->id . "'});load();");
    }
}
