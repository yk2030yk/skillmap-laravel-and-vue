<?php

namespace App\Tools;

class Tool
{
    public $options = [];
    public function __construct($options = [])
    {
        $this->options = $options; 
    }
}