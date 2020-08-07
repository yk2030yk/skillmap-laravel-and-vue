<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 資格カテゴリテーブルのModel。
 * 
 * @author sh_yamada
 */
class CertificationCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function certifications()
    {
        return $this->hasMany('App\Models\Certification', 'certification_category_id');
    }
}