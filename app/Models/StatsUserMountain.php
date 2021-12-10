<?php
namespace App\Models;

class StatsUserMountain extends SlopeSquadBaseModel
{
    use Traits\hasMountain;
    use Traits\hasUser;

    protected $table = 'stats_users_mountains';

    // need these for firstOrCreate() to work
    protected $fillable = [
        'mountain_id',
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

    public function getTotalSeasons(): int
    {
        return $this->total_seasons ?? 0;
    }

    public function setTotalSeasons(int $totalSeasons): void
    {
        $this->total_seasons = $totalSeasons;
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