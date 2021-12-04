<?php
namespace App;

use Illuminate\Support\Facades\DB;

class Areas
{
    public static function getAreaHierarchy(): array
    {
        /**
         * ['United States', 'Canada', ... ]
         */
        $level1 = collect();
        /**
         * [
         *   'United States' => ['East', 'West', ...],
         *   ...
         * ]
         */
        $level2 = collect();
        /**
         * [
         *   'United States:West' => ['California', 'Oregon' ...],
         *   ...
         * ]
         *
         */
        $level3 = collect();

        $allDistinctRegions = DB::table('mountains')->select(DB::raw('distinct region_1, region_2, region_3'))->get();

        foreach ($allDistinctRegions as $regionGroup) {
            $region1 = $regionGroup->region_1;
            $region2 = $regionGroup->region_2;
            $region3 = $regionGroup->region_3;

            if (!$level1->contains($region1)) {
                $level1->push($region1);
            }

            if (!$level2->has($region1)) {
                $level2[$region1] = collect();
            }
            if (!$level2[$region1]->contains($region2)) {
                $level2[$region1]->push($region2);
            }

            $level3key = "{$region1}:{$region2}";
            if (!$level3->has($level3key)) {
                $level3[$level3key] = collect();
            }
            if (!$level3[$level3key]->contains($region3)) {
                $level3[$level3key]->push($region3);
            }
        }

        return [
            $level1,
            $level2,
            $level3,
        ];
    }
}