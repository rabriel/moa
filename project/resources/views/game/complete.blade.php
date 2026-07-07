@extends('layouts.app')

@section('title', 'Complete | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        <x-success-message>
            {{ $player->name }}, that's all 20! Head to the info desk to claim your prize!
        </x-success-message>

        <x-primary-button :href="route('game.index')" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Scan the next Minion QR code you find to reveal your next clue.</p>
    </section>
@endsection
