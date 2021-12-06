<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="index"/>

        {{ $user->getName() }}

    </x-containers.page>
</x-app-layout>
