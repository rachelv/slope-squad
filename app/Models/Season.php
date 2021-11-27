<?php
namespace App\Models;

class Season extends SlopeSquadBaseModel
{
    use Traits\hasRank;

    public function getIsCurrent(): bool
    {
        return $this->is_current;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): string
    {
        $seasons = explode('-', $this->name);

        $firstSeason = substr($seasons[0], -2);
        $secondSeason = substr($seasons[1], -2);

        return "{$firstSeason}-{$secondSeason}";
    }
}