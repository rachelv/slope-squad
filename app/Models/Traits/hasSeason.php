<?php
namespace App\Models\Traits;

use App\Models\Season;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait hasSeason
{
    private $seasonObj = null;

    public function scopeWhereSeasonId(Builder $builder, int $seasonId): Builder
    {
        return $builder->where('season_id', $seasonId);
    }

    public function getSeason(): Season
    {
        if ($this->seasonObj === null) {
            $this->seasonObj = $this->season;
        }
        return $this->seasonObj;
    }

    public function getSeasonId(): int
    {
        return $this->season_id;
    }

    public function setSeasonId(int $seasonId): void
    {
        $this->season_id = $seasonId;
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}