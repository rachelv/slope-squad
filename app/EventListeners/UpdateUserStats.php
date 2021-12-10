<?php
namespace App\EventListeners;

use App\Events\UserAddedSnowday;
use App\Stats;

class UpdateUserStats
{
    public function handle(UserAddedSnowday $event)
    {
        $snowday = $event->getSnowday();

        $userId = $snowday->getUserId();
        $mountainId = $snowday->getMountainId();
        $seasonId = $snowday->getSeasonId();

        Stats::updateUserStats($userId);
        Stats::updateAllForUser($userId, $seasonId, $mountainId);
    }
}