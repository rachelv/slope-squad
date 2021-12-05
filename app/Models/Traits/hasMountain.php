<?php
namespace App\Models\Traits;

use App\Models\Mountain;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait hasMountain
{
    private $mountainObj = null;

    public function scopeWhereMountainId(Builder $builder, int $mountainId): Builder
    {
        return $builder->where('mountain_id', $mountainId);
    }

    public function getMountain(): Mountain
    {
        if ($this->mountainObj === null) {
            $this->mountainObj = $this->mountain;
        }
        return $this->mountainObj;
    }

    public function getMountainId(): int
    {
        return $this->mountain_id ?? 0;
    }

    public function setMountainId(int $mountainId): void
    {
        $this->mountain_id = $mountainId;
    }

    public function mountain(): BelongsTo
    {
        return $this->belongsTo(Mountain::class);
    }
}