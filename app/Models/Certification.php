<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 資格テーブルのModel。
 * 
 * @author sh_yamada
 */
class Certification extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'certification_category_id'];

    public function certificationStatuses()
    {
        return $this->hasMany('App\Models\CertificationStatus', 'certification_id');
    }

    public function certificationCategory()
    {
        return $this->belongsTo('App\Models\CertificationCategory', 'certification_category_id');
    }
}