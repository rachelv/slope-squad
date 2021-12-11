<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Mountain extends SlopeSquadBaseModel
{
    protected $table = 'mountains';

    public static function findOrFail($id, $columns = ['*'])
    {
        if ($id === 0) {
            return Mountain::getBackcountryMock();
        }

        return Mountain::findOrFail($id, $columns);
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', true);
    }

    public function scopeWhereRegions(Builder $builder, string $region1, ?string $region2, ?string $region3): Builder
    {
        $builder = $builder->where('region_1', $region1);
        if ($region2 !== null) {
            $builder = $builder->where('region_2', $region2);
        }
        if ($region3 !== null) {
            $builder = $builder->where('region_3', $region3);
        }

        return $builder;
    }

    public static function getBackcountryMock(): Mountain
    {
        $mountain = new Mountain();
        $mountain->setId(0);
        $mountain->setName('Backcountry');
        return $mountain;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNickname(): string
    {
        return $this->short_name ?? $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getIsInternational(): bool
    {
        return $this->is_international;
    }

    public function getRegion1(): string
    {
        return $this->region_1;
    }

    public function getRegion2(): string
    {
        return $this->region_2;
    }

    public function getRegion3(): string
    {
        return $this->region_3;
    }

    public function getRegion3Abbrev(): string
    {
        return $this->region_3_abbrev;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}