<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <x-user.user-nav :user="$user" active="mountains"/>

        {{ $user->getName() }} mountains

    </x-containers.page>
</x-app-layout>
