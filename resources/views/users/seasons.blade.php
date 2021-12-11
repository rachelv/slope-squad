<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="seasons"/>

        <h2>{{ $user->getName() }} seasons</h2>

        <div class="my-3 space-y-3">
            @forelse($seasonStats as $seasonStat)
                <div>
                    <strong><a href="{{ route_user_season($user, $seasonStat->getSeason()) }}">{{ $seasonStat->getSeason()->getName() }}</a></strong>
                    <div>{{ $seasonStat->getTotalSnowdays() }} {{ Str::plural('day', $seasonStat->getTotalSnowdays() ) }}</div>
                    <div>{{ $seasonStat->getTotalMountains() }} {{ Str::plural('mountain', $seasonStat->getTotalMountains() ) }}</div>
                </div>
            @empty
                <p>none yet</p>
            @endforelse
        </div>

    </x-containers.page>
</x-app-layout>
