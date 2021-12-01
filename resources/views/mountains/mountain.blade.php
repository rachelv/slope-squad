<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        {{ $mountain->getName() }}

    </x-containers.page>
</x-app-layout>
