@props([
    'found' => 0,
    'total' => 20,
])

@php
    $remaining = max($total - $found, 0);
@endphp

<section class="progress-tracker">
    <div class="progress-meta {{ $found === 0 ? 'progress-meta--stacked' : '' }}">
        <span>Bananas found: {{ $found }}/{{ $total }}</span>
        @if ($found === 0)
            <span>{{ $remaining }} to go!</span>
        @else
            <span>| {{ $remaining }} to go!</span>
        @endif
    </div>

    <div class="progress-slots" aria-label="Progress tracker">
        @for ($index = 1; $index <= $total; $index++)
            <img
                src="{{ asset($index <= $found ? 'images/progress-on.png' : 'images/progress-off.png') }}"
                alt=""
                class="progress-slot {{ $index <= $found ? 'is-filled' : '' }}"
                width="12"
                height="45"
            >
        @endfor
    </div>
</section>
