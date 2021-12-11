<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="mountains"/>

        <h2>{{ $user->getName() }} mountains</h2>

        <div class="my-3 space-y-3">
            @forelse($mountainStats as $mountainStat)
                <div>
                    <strong><a href="{{ route_user_mountain($user, $mountainStat->getMountain()) }}">{{ $mountainStat->getMountain()->getName() }}</a></strong>
                    <div>{{ $mountainStat->getTotalSnowdays() }} {{ Str::plural('day', $mountainStat->getTotalSnowdays() ) }}</div>
                    <div>{{ $mountainStat->getTotalSeasons() }} {{ Str::plural('season', $mountainStat->getTotalSeasons() ) }}</div>
                </div>
            @empty
                <p>none yet</p>
            @endforelse
        </div>

    </x-containers.page>
</x-app-layout>
