<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <div class="my-5 space-y-5">
            <div class="flex justify-between">
                <div class="flex flex-col space-y-3">
                    <h3>Recent Days</h3>
                    @foreach ($recentlyActiveUsers as $user)
                        <a class="block font-bold" href="{{ route('users.user', $user) }}">{{ $user->getName() }}</a>
                    @endforeach
                </div>

                <div class="flex flex-col space-y-3">
                    <h3>Newest</h3>
                    @foreach ($newestUsers as $user)
                        <a class="block font-bold" href="{{ route('users.user', $user) }}">{{ $user->getName() }}</a>
                    @endforeach
                </div>

                <div class="flex flex-col space-y-3">
                    <h3>bleh</h3>
                    @foreach ($newestUsers as $user)
                        <a class="block font-bold" href="{{ route('users.user', $user) }}">{{ $user->getName() }}</a>
                    @endforeach
                </div>
            </div>

            <hr/>

            <div class="flex justify-between">
                @foreach ($allUsers->split(3) as $userGroups)
                    <div class="flex flex-col space-y-3">
                        @foreach ($userGroups as $user)
                            <div>
                                <a class="block font-bold" href="{{ route('users.user', $user) }}">{{ $user->getName() }}</a>
                                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-2">
                                    <a class="block" href="{{ route('users.mountains', $user) }}">{{ $user->getTotalMountains() }} {{ Str::plural('mountain', $user->getTotalMountains()) }}</a>
                                    <div class="hidden lg:block">&middot;</div>
                                    <a class="block" href="{{ route('users.seasons', $user) }}">{{ $user->getTotalSeasons() }} {{ Str::plural('season', $user->getTotalSeasons()) }}</a>
                                    <div class="hidden lg:block">&middot;</div>
                                    <a class="block" href="{{ route('users.snowdays', $user) }}">{{ $user->getTotalSnowdays() }} {{ Str::plural('day', $user->getTotalSnowdays()) }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        </div>

    </x-containers.page>
</x-app-layout>
