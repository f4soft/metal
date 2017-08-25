<?php

namespace app\components;


use app\models\Settings;
use yii\base\Component;

class SettingsImporter extends Component
{
    public $settings = false;

    public function init()
    {
        parent::init();
        $data = Settings::find()->all();
        $result = [];
        if (count($data)) {
            foreach ($data as $value) {
                $value["const_name"] = strtolower($value["const_name"]);
                $result[$value["const_name"]] = $value["value"];
            }
            $this->settings = $result;
        }
    }
}