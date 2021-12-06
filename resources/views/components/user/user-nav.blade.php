@props([
    'user',
    'active'
])

@php
    $activeClasses = 'underline font-bold';
@endphp

<ul>
    <li><a class="{{ $active == 'index' ? $activeClasses : '' }}" href="{{ route('users.user', $user) }}">Index</a></li>
    <li><a class="{{ $active == 'seasons' ? $activeClasses : '' }}" href="{{ route('users.seasons', $user) }}">Seasons</a></li>
    <li><a class="{{ $active == 'mountains' ? $activeClasses : '' }}" href="{{ route('users.mountains', $user) }}">Mountains</a></li>
    <li><a class="{{ $active == 'snowdays' ? $activeClasses : '' }}" href="{{ route('users.snowdays', $user) }}">Snowdays</a></li>
    <li><a class="{{ $active == 'following' ? $activeClasses : '' }}" href="{{ route('users.following', $user) }}">Following</a></li>
</ul>