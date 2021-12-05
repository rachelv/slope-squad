<?php
namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\Season;
use App\Models\Snowday;
use App\Models\User;
use App\View\Models\CountUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MountainsController extends SlopeSquadBaseController
{
    const NUM_RECENT_SNOWDAYS = 5;

    const NUM_TOP_SEASON_USERS = 5;
    const NUM_TOP_ALL_TIME_USERS = 5;

    public function mountain(int $id): View
    {
        $mountain = Mountain::findOrFail($id);

        // some recent snowdays at this mountain
        $snowdays = Snowday::with(['user', 'mountain'])
            ->whereMountainId($mountain->getId())
            ->orderByDesc('date')
            ->limit(self::NUM_RECENT_SNOWDAYS)
            ->get();

        $currentSeason = Season::current();

        // most snowdays here all time
        $topUsersOverall = $this->getTopUsers($mountain->getId(), self::NUM_TOP_ALL_TIME_USERS, $seasonId = 0);
        // most snowdays here this season
        $topUsersSeason = $this->getTopUsers($mountain->getId(), self::NUM_TOP_SEASON_USERS, $seasonId = $currentSeason->getId());

        return view('mountains.mountain', [
            'loggedInUser' => $this->getLoggedInUser(),
            'mountain' => $mountain,
            'currentSeason' => $currentSeason,
            'recentSnowdays' => $snowdays,
            'topUsersOverall' => $topUsersOverall,
            'topUsersSeason' => $topUsersSeason,
        ]);
    }

    private function getTopUsers(int $mountainId, int $limit, int $seasonId): Collection
    {
        $countAndUserIds = DB::table('snowdays')
            ->select(DB::raw('count(*) as num_days, user_id'))
            ->where('mountain_id', $mountainId)
            ->when($seasonId > 0, function ($query) use ($seasonId) {
                return $query->where('season_id', $seasonId);
            })
            ->groupBy('user_id')
            ->orderByDesc('num_days')
            ->limit(self::NUM_TOP_ALL_TIME_USERS)
            ->get();

        $userIds = $countAndUserIds->map(function ($row) {
            return $row->user_id;
        });

        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        return $countAndUserIds->map(function ($row) use ($users) {
            return new CountUser($users->get($row->user_id), $row->num_days);
        });
    }
}