@extends('layouts.app')

@section('title', 'Complete | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        <x-success-message class="status-message--primary">
            Bello, {{ $player->name }}! You did it! All 20 bananas found. Fingers crossed you're our lucky winner!
        </x-success-message>

        <x-primary-button :href="route('game.index')" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Keep the hunt going! Scan the next banana QR code for your next clue.</p>
    </section>
@endsection
