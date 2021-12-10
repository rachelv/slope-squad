<?php
namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\Season;
use App\Models\Snowday;
use App\Models\StatsUserMountain;
use App\Models\StatsUserSeasonMountain;
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
}