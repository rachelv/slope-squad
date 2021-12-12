<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserFollowing extends SlopeSquadBaseModel
{
    use Traits\hasUser;

    protected $table = 'users_following';

    private $followingUserObj = null;

    public function getFollowingUser(): User
    {
        if ($this->followingUserObj === null) {
            $this->followingUserObj = $this->followingUser;
        }
        return $this->followingUserObj;
    }

    public function getFollowingUserStats(): StatsUserSeason
    {
        return $this->followingUserStats;
    }

    public function getFollowingUserId(): int
    {
        return $this->following_user_id;
    }

    public function setFollowingUserId(int $followingUserId): void
    {
        $this->following_user_id = $followingUserId;
    }

    public function followingUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_user_id', 'id');
    }

    public function followingUserStats(): HasOne
    {
        $currentSeasonId = Season::current()->getId();

        return $this->hasOne(StatsUserSeason::class, 'user_id', 'following_user_id')
            ->ofMany([
                'id' => 'max',
            ], function ($query) use ($currentSeasonId) {
                $query->where('season_id', $currentSeasonId);
            })->withDefault([
                'season_id' => $currentSeasonId,
                'total_snowdays' => 0,
                'total_mountains' => 0,
                'total_vertical' => 0,
            ]);
    }
}