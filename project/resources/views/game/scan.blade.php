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
        @elseif ($showMissedBananasMessage ?? false)
            <x-error-message>
                Boo-doo! You missed some banana codes! Go hunt again!
            </x-error-message>
        @elseif (($showSuccessMessage ?? true) && filled($successMessage ?? null))
            <x-success-message>
                {{ $successMessage }}
            </x-success-message>
        @endif

        @if ($clueStore ?? null)
            <x-clue-card
                :title="$clueStore->name"
                :text="$clueStore->clue"
            />
        @endif

        <p class="scan-instruction-text">Instructions: Open your device camera to Scan</p>

        <p class="fine-print text-center">Scan the next Minion QR code you find to reveal your next clue.</p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
        <form method="POST" action="{{ route('logout') }}" class="player-session-links">
            @csrf
            <span class="player-session-links__name">{{ strtok($player->name, ' ') }}</span>
            <span class="player-session-links__divider">|</span>
            <button type="submit" class="player-session-links__logout">Logout</button>
        </form>
    </section>
@endsection
