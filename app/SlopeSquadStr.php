<?php
namespace App;

use Illuminate\Support\Str;

class SlopeSquadStr
{
    public static function fromSlug(?string $slug): ?string
    {
        if ($slug !== null) {
            if ($slug === 'mid-atlantic') {
                return ucfirst($slug);
            } else {
                return Str::title(str_replace('-', ' ', $slug));
            }
        }
        return null;
    }
}