<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <h1>{{ $mountain->getName() }}</h1>

        <div class="my-2 space-y-2">
            <h3>Most Recent Snowdays</h3>
            @foreach($recentSnowdays as $snowday)
                <p>
                    <a href="{{ route('users.user', $snowday->getUser()) }}">{{ $snowday->getUser()->getName() }}</a>
                    at <a href="{{ route('mountains.mountain', $snowday->getMountain()) }}">{{ $snowday->getDisplayTitle() }}</a>
                    on {{ format_date($snowday->getDate()) }}
                </p>
            @endforeach
        </div>

        <div class="my-2 space-y-2">
            <h3>Most Snowdays in {{ $currentSeason->getShortName() }}</h3>
            @forelse($topUsersSeason as $seasonMountainStats)
                <p>
                    <strong>{{ $seasonMountainStats->getTotalSnowdays() }}</strong>: <a href="{{ route('users.user', $seasonMountainStats->getUser()) }}">{{ $seasonMountainStats->getUser()->getName() }}</a>
                </p>
            @empty
                <p>none yet</p>
            @endforelse
        </div>

        <div class="my-2 space-y-2">
            <h3>Most Snowdays All Time</h3>
            @forelse($topUsersOverall as $mountainStats)
                <p>
                    <strong>{{ $mountainStats->getTotalSnowdays() }}</strong>: <a href="{{ route('users.user', $mountainStats->getUser()) }}">{{ $mountainStats->getUser()->getName() }}</a>
                </p>
            @empty
                <p>none yet</p>
            @endforelse
        </div>

    </x-containers.page>
</x-app-layout>
