<?php
namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\Season;
use App\Models\Snowday;
use App\Models\StatsUserMountain;
use App\Models\StatsUserSeason;
use App\Models\User;
use App\Models\UserFollowing;
use Illuminate\View\View;

class UsersController extends SlopeSquadBaseController
{
    public function user(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.user', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
        ]);
    }

    public function seasons(int $id): View
    {
        $user = User::findOrFail($id);

        $seasonStats = StatsUserSeason::with(['season'])
            ->whereUserId($user->getId())
            ->get()
            ->sortByDesc(function (StatsUserSeason $seasonStat) {
                return $seasonStat->getSeason()->getRank();
            });

        return view('users.seasons', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'seasonStats' => $seasonStats,
        ]);
    }

    public function season(int $id, int $seasonId): View
    {
        $user = User::findOrFail($id);
        $season = Season::findOrFail($seasonId);

        return view('users.season', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'season' => $season,
        ]);
    }

    public function mountains(int $id): View
    {
        $user = User::findOrFail($id);

        $mountainStats = StatsUserMountain::with(['mountain'])
            ->whereUserId($user->getId())
            ->orderByDesc('total_snowdays')
            ->get();

        return view('users.mountains', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'mountainStats' => $mountainStats,
        ]);
    }

    public function mountain(int $id, int $mountainId): View
    {
        $user = User::findOrFail($id);
        $mountain = Mountain::findOrFail($mountainId);

        return view('users.mountain', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'mountain' => $mountain,
        ]);
    }

    public function snowdays(int $id): View
    {
        $user = User::findOrFail($id);

        $snowdays = Snowday::with(['mountain', 'season'])
            ->whereUserId($user->getId())
            ->limit(50)
            ->orderByDesc('date')
            ->get();

        return view('users.snowdays', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'snowdays' => $snowdays,
        ]);
    }

    public function snowday(int $id, int $snowdayId): View
    {
        $user = User::findOrFail($id);
        $snowday = Snowday::findOrFail($snowdayId);

        return view('users.snowday', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'snowday' => $snowday,
        ]);
    }

    public function following(int $id): View
    {
        $user = User::findOrFail($id);

        $followingUsers = UserFollowing::with(['followingUser', 'followingUserStats'])
            ->whereUserId($user->getId())
            ->get()
            ->sortByDesc(function (UserFollowing $userFollowing) {
                return $userFollowing->getFollowingUserStats()->getTotalSnowdays();
            });

        return view('users.following', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
            'followingUsers' => $followingUsers,
        ]);
    }
}