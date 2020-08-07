<?php

namespace App\Http\Controllers\Front\Skillmap;

use App\Http\Controllers\Front\FrontController;

use App\Models\Skill;
use App\Models\Member;
use App\Models\Team;
use App\Service\DataShapeService;
use App\Models\SkillLargeCategory;
use App\Models\SkillSmallCategory;
use App\Models\Certification;
use App\Models\CertificationCategory;

class UpdateController extends FrontController
{
    public function member($id)
    {
        $member = Member::find($id);
        return $this->view([
            'member' => $member,
            'teams'  => Team::with([])->get(),
            'skills' => Skill::with('skillSmallCategory.skillLargeCategory')->get(),
        ]);
    }
}