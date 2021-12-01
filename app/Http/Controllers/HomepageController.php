<?php
namespace App\Http\Controllers;

use App\Models\Snowday;
use Illuminate\View\View;

class HomepageController extends SlopeSquadBaseController
{
    public function index(): View
    {
        $recentSnowdays = Snowday::with(['user', 'mountain'])->orderByNewest()->limit(5)->get();

        return view('homepage.index', [
            'loggedInUser' => $this->getLoggedInUser(),
            'recentSnowdays' => $recentSnowdays,
        ]);
    }
}