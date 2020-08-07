<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * スキルレベルテーブルのModel。
 * 
 * @author sh_yamada
 */
class SkillLevel extends Model
{
    public function skill()
    {
        return $this->belongsTo('App\Models\Skill', 'skill_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
}