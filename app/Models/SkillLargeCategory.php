<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * スキル大カテゴリテーブルのModel。
 * 
 * @author sh_yamada
 */
class SkillLargeCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    function skillSmallCategories()
    {
        return $this->hasMany('App\Models\SkillSmallCategory', 'skill_large_category_id');
    }
}