<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * スキルレベルテーブルのModel。
 * 
 * @author sh_yamada
 */
class SkillLevelFeature extends Model
{
	protected $table = 'skill_levels_feature';
    public function skill()
    {
        return $this->belongsTo('App\Models\Skill', 'skill_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
}