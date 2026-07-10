<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $shareTitle = trim($__env->yieldContent('title', 'Mall of the North QR Hunt'));
        $shareDescription = trim($__env->yieldContent('meta_description', 'Find all 20 hidden bananas in participating store windows for a chance to win a Mall of the North gift card.'));
        $shareUrl = url()->current();
        $shareImage = asset('og-image.png');
    @endphp
    <title>@yield('title', 'Mall of the North QR Hunt')</title>
    <meta name="description" content="{{ $shareDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $shareTitle }}">
    <meta property="og:description" content="{{ $shareDescription }}">
    <meta property="og:url" content="{{ $shareUrl }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:image:alt" content="Mall of the North Minions clue hunt campaign image">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $shareTitle }}">
    <meta name="twitter:description" content="{{ $shareDescription }}">
    <meta name="twitter:image" content="{{ $shareImage }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-icon-180x180.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <main class="app-wrapper">
            @yield('content')
            <div class="footer-brand">
                <img src="{{ asset('images/footer-logo.png') }}" alt="Illumination's Minions and Monsters" class="footer-brand__image">
            </div>
        </main>
    </div>
</body>
</html>
