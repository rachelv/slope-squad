<?php

namespace App\Models\Traits;

trait hasRank
{
    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }
}