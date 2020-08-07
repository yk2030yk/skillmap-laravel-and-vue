<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 資格ステータステーブルのModel。
 * 
 * @author sh_yamada
 */
class CertificationStatus extends Model
{
    public function certification()
    {
        return $this->belongsTo('App\Models\Certification', 'certification_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }
}