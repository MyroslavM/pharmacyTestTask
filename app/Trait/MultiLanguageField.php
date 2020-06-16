<?php

namespace App\Traits;


trait MultiLanguageField
{
    public $multiLanguageFields = [];

    public function __set($name, $arguments)
    {
        if (in_array($name, $this->multiLanguageFields)) {
            return $this->attributes[$name] = json_encode($arguments);
        }

        return parent::__set($name, $arguments);
    }
}