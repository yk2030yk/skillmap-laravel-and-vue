<?php

namespace App\Http\Controllers\Front;

use App\Service\Skillmap;
use App\Service\SkillmapFilter;
use App\Http\Requests\ApiRequest;

class SkillmapController
{
    public function index()
    {
        return response()->json(
            Skillmap::get() +
            SkillmapFilter::get()
        );
    }
}