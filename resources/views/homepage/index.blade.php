<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        <div class="flex flex-col items-center space-y-4 my-8 text-center">
            <h1>Simple Ski Day Tracking For Avid Skiers</h1>
            <div class="space-y-1">
                <h4>Log your days, view your stats, and follow your friends.</h4>
                <h4>No app, nothing fancy &mdash; just a nice way to remember your days on the snow.</h4>
            </div>
        </div>

        {{--
            compare stats across seasons
            explore a map of everywhere you've skied
            see your most visited mountains over time
            easily keep up with your friends days
        --}}

    </x-containers.page>
</x-app-layout>
