<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="following"/>

        <h2>{{ $user->getName() }} following</h2>

        @forelse ($followingUsers as $followingUser)
            <div>
                <span>{{ $followingUser->getFollowingUserStats()->getTotalSnowdays() }}</span>
                <a href="{{ route('users.user', $followingUser->getFollowingUser()) }}">{{ $followingUser->getFollowingUser()->getName() }}</a>
            </div>
        @empty
            <p>{{ $user->getName() }} isn't following anyone yet</p>
        @endforelse
    </x-containers.page>
</x-app-layout>
