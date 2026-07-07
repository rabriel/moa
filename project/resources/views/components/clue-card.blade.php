@props([
    'title' => '',
    'text' => '',
])

<section class="clue-card">
    <h2 class="clue-card-title">{{ $title }}</h2>
    <p class="clue-card-text">{{ $text }}</p>
</section>
