<?php

namespace App\Http\Controllers\Front\Skillmap;

use App\Service\SkillLevelAnalytics;
use App\Service\ChartData;
use App\Models\SkillLargeCategory;

class AnalyticsController
{
    public function skillLevel()
    {
        $analytics = new SkillLevelAnalytics();
        return response()->json([
            'data' => [
                'skill'              => collect($analytics->getAverage_skill()),
                'skillSmallCategory' => collect($analytics->getAverage_skillSmallCategory()),
                'skillLargeCategory' => collect($analytics->getAverage_skillLargeCategory()),
            ],
            'skillLargeCategories' => SkillLargeCategory::all(),
        ]);
    }
}