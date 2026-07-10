@extends('layouts.app')

@section('title', 'Scan | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        @if ($isDuplicateVisit)
            <x-error-message>
                You've already logged this store - here's the clue again.
            </x-error-message>
        @else
            <x-success-message>
                {{ $successMessage }}
            </x-success-message>
        @endif

        <x-clue-card
            :title="$store->name"
            :text="$store->clue"
        />

        <x-primary-button :href="route('game.index')" class="button-wrap">
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Keep the hunt going! Scan the next banana QR code for your next clue.</p>
    </section>
@endsection
