<?php

namespace App\Service;

use App\Models\SkillLargeCategory;
use App\Models\SkillSmallCategory;
use App\Models\CertificationCategory;
use App\Models\Team;
use App\Service\Annual;

class SkillmapFilter
{
    public static function get()
    {
        return [
            'skillLargeCategories'    => SkillLargeCategory::with([])->get(),
            'skillSmallCategories'    => SkillSmallCategory::with([])->get(),
            'certificationCategories' => CertificationCategory::with([])->get(),
            'teams'                   => Team::with([])->get(),
            'annuals'                 => Annual::get(),
        ];
    }
}