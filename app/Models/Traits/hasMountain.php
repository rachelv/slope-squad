<?php
namespace App\Models\Traits;

trait hasMountain
{
    public function getMountainId(): int
    {
        return $this->mountain_kd;
    }

    public function setMountainId(int $mountainId): void
    {
        $this->mountain_id = $mountainId;
    }
}