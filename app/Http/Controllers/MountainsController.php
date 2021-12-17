<?php
namespace App\Http\Controllers;

use App\Areas;
use App\Models\Mountain;
use App\Models\Season;
use App\Models\Snowday;
use App\Models\StatsUserMountain;
use App\Models\StatsUserSeasonMountain;
use App\SlopeSquadStr;
use Illuminate\View\View;

class MountainsController extends SlopeSquadBaseController
{
    const NUM_RECENT_SNOWDAYS = 5;

    const NUM_TOP_SEASON_USERS = 5;
    const NUM_TOP_ALL_TIME_USERS = 5;

    public function mountain(int $id): View
    {
        $mountain = Mountain::findOrFail($id);

        // some recent snowdays at this mountain
        $snowdays = Snowday::with(['user', 'mountain'])
            ->whereMountainId($mountain->getId())
            ->orderByDesc('date')
            ->limit(self::NUM_RECENT_SNOWDAYS)
            ->get();

        $currentSeason = Season::current();

        // most snowdays here all time
        $topUsersOverall = StatsUserMountain::with(['user'])
            ->whereMountainId($mountain->getId())
            ->orderByDesc('total_snowdays')
            ->limit(self::NUM_TOP_ALL_TIME_USERS)
            ->get();

        // most snowdays here this season
        $topUsersSeason = StatsUserSeasonMountain::with(['user'])
            ->whereMountainId($mountain->getId())
            ->whereSeasonId($currentSeason->getId())
            ->orderByDesc('total_snowdays')
            ->limit(self::NUM_TOP_SEASON_USERS)
            ->get();

        return view('mountains.mountain', [
            'loggedInUser' => $this->getLoggedInUser(),
            'mountain' => $mountain,
            'currentSeason' => $currentSeason,
            'recentSnowdays' => $snowdays,
            'topUsersOverall' => $topUsersOverall,
            'topUsersSeason' => $topUsersSeason,
        ]);
    }

    public function browse(): View
    {
        $areas = Areas::getAreaHierarchy();

        return view('mountains.browse', [
            'loggedInUser' => $this->getLoggedInUser(),
            'level1areas' => $areas[0],
            'level2areas' => $areas[1],
            'level3areas' => $areas[2],
        ]);
    }

    public function browseRegion(string $region1, ?string $region2 = null, ?string $region3 = null)
    {
        $region1 = SlopeSquadStr::fromSlug($region1);
        $region2 = SlopeSquadStr::fromSlug($region2);
        $region3 = SlopeSquadStr::fromSlug($region3);

        $mountains = Mountain::whereRegions($region1, $region2, $region3)->get();

        return view('mountains.browse-region', [
            'loggedInUser' => $this->getLoggedInUser(),
            'mountains' => $mountains,
        ]);
    }
}