<?php
namespace App\Http\Controllers;

use App\Areas;
use App\Models\Mountain;
use App\SlopeSquadStr;
use Illuminate\View\View;

class BrowseController extends SlopeSquadBaseController
{
    public function mountains(): View
    {
        $areas = Areas::getAreaHierarchy();

        return view('browse.mountains', [
            'loggedInUser' => $this->getLoggedInUser(),
            'level1areas' => $areas[0],
            'level2areas' => $areas[1],
            'level3areas' => $areas[2],
        ]);
    }

    public function region(string $region1, ?string $region2 = null, ?string $region3 = null)
    {
        $region1 = SlopeSquadStr::fromSlug($region1);
        $region2 = SlopeSquadStr::fromSlug($region2);
        $region3 = SlopeSquadStr::fromSlug($region3);

        $mountains = Mountain::whereRegions($region1, $region2, $region3)->get();

        return view('browse.region', [
            'loggedInUser' => $this->getLoggedInUser(),
            'mountains' => $mountains,
        ]);
    }
}