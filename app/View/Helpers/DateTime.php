<?php
use Carbon\Carbon;

// Saturday, December 4, 2021
const DATE_FULL = 'l, F j, Y';

function format_date(Carbon $datetime, string $format = DATE_FULL): string
{
    return $datetime->format($format);
}