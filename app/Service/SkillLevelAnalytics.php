<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
use App\Models\SkillLargeCategory;
use App\Models\SkillSmallCategory;
use App\Models\Certification;
use App\Models\CertificationCategory;

class SkillLevelAnalytics
{
    private $SLV_CURRENT_TABLE = 'skill_levels';
    private $SLV_FEATURE_TABLE = 'skill_levels_feature';
    private $S_TABLE   = 'skills';
    private $SSC_TABLE = 'skill_small_categories';
    private $SLC_TABLE = 'skill_large_categories';

    public function __construct($isFeature = false)
    {
    }

    private function format($averageData = [])
    {
        $sortedAverageData = $averageData;
        $result = [];
        foreach ($sortedAverageData as $data) {
            $result[] = [
                'skill_name'                => property_exists($data, 'skill_name')                ? $data->skill_name                : '',
                'skill_id'                  => property_exists($data, 'skill_id')                  ? $data->skill_id                  : '',
                'skill_large_category_name' => property_exists($data, 'skill_large_category_name') ? $data->skill_large_category_name : '',
                'skill_large_category_id'   => property_exists($data, 'skill_large_category_id')   ? $data->skill_large_category_id   : '',
                'skill_small_category_name' => property_exists($data, 'skill_small_category_name') ? $data->skill_small_category_name : '',
                'skill_small_category_id'   => property_exists($data, 'skill_small_category_id')   ? $data->skill_small_category_id   : '',
                'average_current'           => property_exists($data, 'average_current')           ? $data->average_current           : 0,
                'average_feature'           => property_exists($data, 'average_feature')           ? $data->average_feature           : 0,
            ];
        }
        return $result;
    }

    public function getAverage($target, $select = [], $where = [])
    {
        return DB::table("{$this->SLV_CURRENT_TABLE}")
            ->join("{$this->SLV_FEATURE_TABLE}", function($join) {
                $join->on("{$this->SLV_CURRENT_TABLE}.skill_id", '=', "{$this->SLV_FEATURE_TABLE}.skill_id");
                $join->on("{$this->SLV_CURRENT_TABLE}.member_id", '=', "{$this->SLV_FEATURE_TABLE}.member_id");
            })
            ->join("{$this->S_TABLE}",   "{$this->SLV_CURRENT_TABLE}.skill_id",        '=', "{$this->S_TABLE}.id")
            ->join("{$this->SSC_TABLE}", "{$this->S_TABLE}.skill_small_category_id",   '=', "{$this->SSC_TABLE}.id")
            ->join("{$this->SLC_TABLE}", "{$this->SSC_TABLE}.skill_large_category_id", '=', "{$this->SLC_TABLE}.id")
            ->select(array_merge([
                DB::raw("avg({$this->SLV_CURRENT_TABLE}.level) AS average_current"),
                DB::raw("avg({$this->SLV_FEATURE_TABLE}.level) AS average_feature"),
            ], $select))
            ->groupBy("{$target}.id")
            ->orderBy('average_current')
            ->where($where)
            ->get();
    }

    public function getAverage_skill($param = [])
    {
        $select = [
            "{$this->S_TABLE}.id     AS skill_id",
            "{$this->S_TABLE}.name   AS skill_name",
            "{$this->SLC_TABLE}.id   AS skill_large_category_id",
            "{$this->SLC_TABLE}.name AS skill_large_category_name",
            "{$this->SSC_TABLE}.id   AS skill_small_category_id",
            "{$this->SSC_TABLE}.name AS skill_small_category_name",
        ];
        $data = $this->getAverage($this->S_TABLE, $select);
        return $this->format($data);
    }

    public function getAverage_skillLargeCategory($param = [])
    {
        $select = [
            "{$this->SLC_TABLE}.id   AS skill_large_category_id",
            "{$this->SLC_TABLE}.name AS skill_large_category_name",
        ];
        $data = $this->getAverage($this->SLC_TABLE, $select);
        return $this->format($data);
    }

    public function getAverage_skillSmallCategory($param =[])
    {
        $select = [
            "{$this->SLC_TABLE}.id   AS skill_large_category_id",
            "{$this->SLC_TABLE}.name AS skill_large_category_name",
            "{$this->SSC_TABLE}.id   AS skill_small_category_id",
            "{$this->SSC_TABLE}.name AS skill_small_category_name",
        ];
        $data = $this->getAverage($this->SSC_TABLE, $select);
        return $this->format($data);
    }
}