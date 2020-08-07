<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Service\Annual;

/**
 * メンバー(社員)テーブルのModel。
 * 
 * @author sh_yamada
 */
class Member extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'team_id'];
    protected $appends = ['annual'];
    private $chacheAttribute = [];

    public function getAnnualAttribute()
    {
        return Annual::parse($this->id);
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }

    public function skillLevels()
    {
        return $this->hasMany('App\Models\SkillLevel', 'member_id');
    }

    public function skillLevelsFeature()
    {
        return $this->hasMany('App\Models\SkillLevelFeature', 'member_id');
    }

    public function certificationStatuses()
    {
        return $this->hasMany('App\Models\CertificationStatus', 'member_id');
    }
}