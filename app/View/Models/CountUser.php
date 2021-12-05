<?php
namespace App\View\Models;

use App\Models\User;

class CountUser
{
    private User $user;
    private int $count;

    public function __construct(User $user, int $count)
    {
        $this->user = $user;
        $this->count = $count;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}