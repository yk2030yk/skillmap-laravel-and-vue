<?php

namespace App\Tools;
use App\Tools\Tool;

class SkillLevelLoader extends Tool
{
    private $SLV_TABLE = 'skill_levels';
    private $S_TABLE   = 'skills';
    private $SSC_TABLE = 'skill_small_categories';
    private $SLC_TABLE = 'skill_large_categories';

    public function index()
    {
        print_r($this->options);
        if (!isset($this->options['path'])) {
            print("pathが指定されていません。\n");
            return;
        }
        $path = base_path($this->options['path']);
        print($path . "を読み込みます");
        if (!file_exists($path)) {
            print('ファイルが存在しません。');
            return;
        }
        $this->load($path);
    }

    private function load($path) {
        $f = fopen($path, "r");
        while ($line = fgetcsv($f, 0, "\t")) {
            print($line[0] . "さんのデータを読み込みます\n");
        }
    }
}