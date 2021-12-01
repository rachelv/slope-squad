<?php
namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait hasUser
{
    private $userObj = null;

    public function getUser(): User
    {
        if ($this->userObj === null) {
            $this->userObj = $this->user;
        }
        return $this->userObj;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}