<x-app-layout>
    <x-slot name="title">{{ page_title() }}</x-slot>

    <x-containers.page :logged-in-user="$loggedInUser">

        @foreach($mountains as $mountain)
            <div class="my-2">
                <a class="block" href="{{ route('mountains.mountain', $mountain) }}">{{ $mountain->getName() }}</a>
                <p>{{ $mountain->getCity() }}, {{ $mountain->getRegion3Abbrev() }}</p>
            </div>
        @endforeach


    </x-containers.page>
</x-app-layout>
