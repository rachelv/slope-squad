<?php
namespace App\Http\Controllers;

use App\Models\User;
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

        return view('users.seasons', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
        ]);
    }

    public function mountains(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.mountains', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
        ]);
    }

    public function snowdays(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.snowdays', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
        ]);
    }

    public function following(int $id): View
    {
        $user = User::findOrFail($id);

        return view('users.following', [
            'loggedInUser' => $this->getLoggedInUser(),
            'user' => $user,
        ]);
    }
}