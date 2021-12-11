<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="snowdays"/>

        <h2>{{ $user->getName() }} snowday at {{ $snowday->getDisplayTitle() }}</h2>
        <div>{{ format_date($snowday->getDate()) }}</div>

    </x-containers.page>
</x-app-layout>
