<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        @foreach($level1areas as $level1)
            <h2>{{ $level1 }}</h2>

            @foreach($level2areas->get($level1) as $level2)
                <h3 class="ml-4">{{ $level2 }}</h3>

                @foreach($level3areas->get($level1 . ':' . $level2) as $level3)
                    <h4 class="ml-8"><a href="{{ route_browse_mountains($level1, $level2, $level3) }}">{{ $level3 }}</a></h4>
                @endforeach

            @endforeach

        @endforeach


    </x-containers.page>
</x-app-layout>
