<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * スキル小カテゴリテーブルのModel。
 * 
 * @author sh_yamada
 */
class SkillSmallCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'skill_large_category_id'];

    public function skillLargeCategory()
    {
        return $this->belongsTo('App\Models\SkillLargeCategory', 'skill_large_category_id');
    }

    public function skills()
    {
        return $this->hasMany('App\Models\Skill', 'skill_small_category_id');
    }
}