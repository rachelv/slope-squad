<?php
namespace App\Models;

class StatsUserSeason extends SlopeSquadBaseModel
{
    use Traits\hasSeason;
    use Traits\hasUser;

    protected $table = 'stats_users_seasons';

    // need these for firstOrCreate() to work
    protected $fillable = [
        'season_id',
        'user_id',
    ];

    public function getTotalSnowdays(): int
    {
        return $this->total_snowdays ?? 0;
    }

    public function setTotalSnowdays(int $totalSnowdays): void
    {
        $this->total_snowdays = $totalSnowdays;
    }

    public function getTotalMountains(): int
    {
        return $this->total_moundains ?? 0;
    }

    public function setTotalMountains(int $totalMountains): void
    {
        $this->total_moundains = $totalMountains;
    }

    public function getTotalVertical(): int
    {
        return $this->total_vertical ?? 0;
    }

    public function setTotalVertical(int $totalVertical): void
    {
        $this->total_vertical = $totalVertical;
    }
}