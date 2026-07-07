@props([
    'title' => '',
    'subtitle' => null,
    'showLogo' => true,
])

<header class="game-header">
    @if ($showLogo)
        <img src="{{ asset('images/header-background.png') }}" alt="Meet Henry and James" class="game-header__hero">
    @endif

    @if ($title !== '')
        <h1 class="game-header__title">{{ $title }}</h1>
    @endif

    @if ($subtitle)
        <p class="game-header__subtitle">{{ $subtitle }}</p>
    @endif
</header>
