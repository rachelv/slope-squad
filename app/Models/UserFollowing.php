<?php
namespace App\Models;

class UserFollowing extends SlopeSquadBaseModel
{
    use Traits\hasUser;

    protected $table = 'users_following';

    public function getFollowingUserId(): int
    {
        return $this->following_user_id;
    }

    public function setFollowingUserId(int $followingUserId): void
    {
        $this->following_user_id = $followingUserId;
    }
}