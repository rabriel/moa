@extends('layouts.app')

@section('title', 'Complete | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        <x-success-message class="status-message--primary">
            Bello, {{ $player->name }}! You did it! All 20 bananas found. Fingers crossed you're our lucky winner!
        </x-success-message>

        <x-primary-button type="button" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Scan the next Minion QR code you find to reveal your next clue.</p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
    </section>
@endsection
