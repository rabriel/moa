@extends('layouts.app')

@section('title', 'Game | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        @if (session('status'))
            <x-success-message>
                {{ session('status') }}
            </x-success-message>
        @endif

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        <p class="instruction-copy">Scan a Minion QR code at any store to reveal your next clue.</p>

        <x-primary-button :href="route('scan.show', ['store' => 'ackermans'])" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Scan the next Minion QR code you find to reveal your next clue.</p>
    </section>
@endsection
