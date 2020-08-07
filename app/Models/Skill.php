<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * スキルテーブルのModel。
 * 
 * @author sh_yamada
 */
class Skill extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'skill_small_category_id'];

    public function skillSmallCategory()
    {
        return $this->belongsTo('App\Models\SkillSmallCategory', 'skill_small_category_id');
    }

    public function skillLevels()
    {
        return $this->hasMany('App\Models\SkillLevel', 'skill_id');
    }
}