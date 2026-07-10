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

        <p class="instruction-copy">Found a banana? Scan the QR code to reveal your next destination!</p>

        <x-primary-button :href="route('scan.show', ['store' => 'ackermans'])" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Keep the hunt going! Scan the next banana QR code for your next clue.</p>
    </section>
@endsection
