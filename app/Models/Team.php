<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * チームテーブルのModel
 * 
 * @author sh_yamada
 */
class Team extends Model
{
    public $timestamps = false;

    public function members()
    {
        return $this->hasMany('App\Models\Member', 'team_id');
    }
}
