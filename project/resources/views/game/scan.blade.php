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
        @elseif (($showSuccessMessage ?? true) && filled($successMessage ?? null))
            <x-success-message>
                {{ $successMessage }}
            </x-success-message>
        @endif

        <x-clue-card
            :title="$store->name"
            :text="$store->clue"
        />

        <x-primary-button type="button" class="button-wrap" data-open-scanner>
            Scan Now
        </x-primary-button>

        <p class="fine-print text-center">Scan the next Minion QR code you find to reveal your next clue.</p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
    </section>
@endsection
