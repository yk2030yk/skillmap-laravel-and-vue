<?php

namespace App\Http\Controllers\Front\Skillmap\Form;

use App\Models\Skill;
use App\Models\Member;
use App\Models\Team;
use App\Service\DataShapeService;
use App\Models\SkillLargeCategory;
use App\Models\SkillSmallCategory;
use App\Models\Certification;
use App\Models\CertificationCategory;
use App\Http\Requests\ApiRequest;

class CreateController
{
    public function member()
    {
        return response()->json([
            'teams' => Team::with([])->get(),
        ]);
    }

    public function skillLargeCategory()
    {
        return response()->json([
        ]);
    }

    public function skillSmallCategory()
    {
        return response()->json([
            'skillLargeCategories' => SkillLargeCategory::with([])->get(),
        ]);
    }

    public function skill()
    {
        return response()->json([
            'skillLargeCategories' => SkillLargeCategory::with([])->get(),
            'skillSmallCategories' => SkillSmallCategory::with([])->get(),
        ]);
    }

    public function certificationCategory()
    {
        return response()->json([
        ]);
    }

    public function certification()
    {
        return response()->json([
            'certificationCategories' => CertificationCategory::with([])->get(),
        ]);
    }
}