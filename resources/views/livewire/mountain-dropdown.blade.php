<div>
    <input wire:model="search" type="text" placeholder="mountain"/>

    @foreach($mountains as $mountain)
        <div class="text-xs">{{ $mountain->getName() }}, {{ $mountain->getRegion3Abbrev() }}</div>
    @endforeach
</div>
