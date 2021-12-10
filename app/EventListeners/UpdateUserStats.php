<?php
namespace App\EventListeners;

use App\Events\UserAddedSnowday;
use App\Models\StatsUserMountain;
use App\Models\StatsUserSeason;
use App\Models\StatsUserSeasonMountain;
use Illuminate\Support\Facades\DB;

class UpdateUserStats
{
    public function handle(UserAddedSnowday $event)
    {
        $snowday = $event->getSnowday();

        $userId = $snowday->getUserId();
        $mountainId = $snowday->getMountainId();
        $seasonId = $snowday->getSeasonId();

        $this->updateSeasonStats($userId, $seasonId);
        $this->updateMountainStats($userId, $mountainId);
        $this->updateSeasonMountainStats($userId, $seasonId, $mountainId);
    }

    private function updateSeasonStats(int $userId, int $seasonId): void
    {
        $seasonMountains = DB::table('snowdays')
            ->select(DB::raw('distinct(mountain_id)'))
            ->where('user_id', $userId)
            ->where('season_id', $seasonId)
            ->count();

        $seasonSnowdays = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('season_id', $seasonId)
            ->count();

        $seasonVertical = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('season_id', $seasonId)
            ->sum('vertical');

        $userSeasonStats = StatsUserSeason::firstOrCreate([
            'user_id' => $userId,
            'season_id' => $seasonId,
        ]);
        $userSeasonStats->setTotalMountains($seasonMountains);
        $userSeasonStats->setTotalSnowdays($seasonSnowdays);
        $userSeasonStats->setTotalVertical($seasonVertical);
        $userSeasonStats->save();
    }

    private function updateMountainStats(int $userId, int $mountainId): void
    {
        $mountainSeasons = DB::table('snowdays')
            ->select(DB::raw('distinct(season_id)'))
            ->where('user_id', $userId)
            ->where('mountain_id', $mountainId)
            ->count();

        $mountainSnowdays = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('mountain_id', $mountainId)
            ->count();

        $mountainVertical = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('mountain_id', $mountainId)
            ->sum('vertical');

        $userMountainStats = StatsUserMountain::firstOrCreate([
            'mountain_id' => $mountainId,
            'user_id' => $userId,
        ]);
        $userMountainStats->setTotalSeasons($mountainSeasons);
        $userMountainStats->setTotalSnowdays($mountainSnowdays);
        $userMountainStats->setTotalVertical($mountainVertical);
        $userMountainStats->save();
    }

    private function updateSeasonMountainStats(int $userId, int $seasonId, int $mountainId): void
    {
        $mountainSeasonSnowdays = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('season_id', $seasonId)
            ->where('mountain_id', $mountainId)
            ->count();

        $mountainSeasonVertical = DB::table('snowdays')
            ->where('user_id', $userId)
            ->where('season_id', $seasonId)
            ->where('mountain_id', $mountainId)
            ->sum('vertical');

        $userSeasonMountainStats = StatsUserSeasonMountain::firstOrCreate([
            'mountain_id' => $mountainId,
            'season_id' => $seasonId,
            'user_id' => $userId,
        ]);
        $userSeasonMountainStats->setTotalSnowdays($mountainSeasonSnowdays);
        $userSeasonMountainStats->setTotalVertical($mountainSeasonVertical);
        $userSeasonMountainStats->save();
    }
}