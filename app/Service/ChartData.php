<?php

namespace App\Service;

class ChartData
{
    private function format($idName = '', $current = [], $feature = [])
    {
        $mappedCurrent = collect($current)->mapWithKeys(function($item) use ($idName) {
            return [$item[$idName] => $item];
        });
        $mappedFeature = collect($feature)->mapWithKeys(function($item) use ($idName) {
            return [$item[$idName] => $item];
        });

        $result = ['current' => [], 'feature' => []];
        $sorted = collect($current)->sortBy('average');
        foreach($sorted as $item) {
            $id = $item[$idName];
            $result['current'][] = $mappedCurrent[$id];
            $result['feature'][] = $mappedFeature[$id];
        }
        return $result;
    }


    public function formatSkill($current = [], $feature = [])
    {
        return $this->format('skill_id', $current, $feature);
    }

    public function formatSkillSmallCategory($current = [], $feature = [])
    {
       return $this->format('skill_small_category_id', $current, $feature);
    }

    public function formatSkillLargeCategory($current = [], $feature = [])
    {
        return $this->format('skill_large_category_id', $current, $feature);
    }
}