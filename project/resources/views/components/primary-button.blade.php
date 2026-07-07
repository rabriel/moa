@props([
    'href' => null,
    'type' => 'button',
    'small' => false,
    'labelClass' => '',
])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class(['btn-primary-game', 'btn-primary-game--small' => $small]) }}>
        <span class="{{ $labelClass }}">{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['btn-primary-game', 'btn-primary-game--small' => $small]) }}>
        <span class="{{ $labelClass }}">{{ $slot }}</span>
    </button>
@endif
