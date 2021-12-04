<?php
use Illuminate\Support\Str;

function route_browse(string $region1, ?string $region2 = null, ?string $region3 = null): string
{
    return route('browse.region', [
        'region1' => Str::slug($region1),
        'region2' => Str::slug($region2),
        'region3' => Str::slug($region3),
    ]);
}