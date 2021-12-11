<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="seasons"/>

        <h2>{{ $user->getName() }} season {{ $season->getName() }}</h2>

    </x-containers.page>
</x-app-layout>
