<?php
namespace App\Models\Traits;

trait hasSeason
{
    public function getSeasonId(): int
    {
        return $this->season_id;
    }

    public function setSeasonId(int $seasonId): void
    {
        $this->season_id = $seasonId;
    }
}