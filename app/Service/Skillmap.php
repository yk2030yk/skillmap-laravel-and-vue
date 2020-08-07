<?php

namespace App\Service;

use App\Models\Skill;
use App\Models\Member;
use App\Models\Certification;

class Skillmap
{
    public static function get()
    {
        $members = Member::with(['skillLevels'])->get();
        $skills  = Skill::with('skillSmallCategory.skillLargeCategory')->get();
        $certifications = Certification::with('certificationCategory')->get();
 
        $formatMembers = [];
        foreach($members as $member) {
            $formatMembers[] = [
                'id'         => $member->id,
                'name'       => $member->name,
                'annual'     => $member->annual,
                'teamId'     => $member->team_id,
                'skillLevel' => $member->skillLevels->mapWithKeys(function ($skill) {
                    return [$skill['skill_id'] => $skill['level']];
                }),
                'certificationStatus'
                             => $member->certificationStatuses->pluck('certification_id'),
            ];
        }
        return [
            'members'        => collect($formatMembers),
            'skills'         => $skills,
            'certifications' => $certifications,
        ];
    }
}