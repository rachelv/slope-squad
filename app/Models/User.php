<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends SlopeSquadBaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_logged_in_at' => 'datetime',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalMountains(): int
    {
        return $this->total_mountains ?? 0;
    }

    public function setTotalMountains(int $totalMountains): void
    {
        $this->total_mountains = $totalMountains;
    }

    public function getTotalSnowdays(): int
    {
        return $this->total_snowdays ?? 0;
    }

    public function setTotalSnowdays(int $totalSnowdays): void
    {
        $this->total_snowdays = $totalSnowdays;
    }

    public function getTotalSeasons(): int
    {
        return $this->total_seasons ?? 0;
    }

    public function setTotalSeasons(int $totalSeasons): void
    {
        $this->total_seasons = $totalSeasons;
    }

    public function getTotalFriends(): int
    {
        return $this->total_friends ?? 0;
    }

    public function setTotalFriends(int $totalFriends): void
    {
        $this->total_friends = $totalFriends;
    }

    public function getLastLoggedInAt(): Carbon
    {
        return $this->last_logged_in_at ?? new Carbon(0);
    }

    public function setLastLoggedInAt(int $lastLoggedInAt): void
    {
        $this->last_logged_in_at = $lastLoggedInAt;
    }
}