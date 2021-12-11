<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="snowdays"/>

        <h2>{{ $user->getName() }} snowdays</h2>

        <div class="my-3 space-y-3">
            @forelse($snowdays as $snowday)
                <div>
                    <strong><a href="{{ route_user_snowday($user, $snowday) }}">{{ $snowday->getDisplayTitle() }}</a></strong>
                    <div>{{ format_date($snowday->getDate()) }}</div>
                    <div>{{ $snowday->getSeason()->getName() }}</div>
                </div>
            @empty
                <p>none yet</p>
            @endforelse
        </div>

    </x-containers.page>
</x-app-layout>
