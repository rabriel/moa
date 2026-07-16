@extends('layouts.app')

@section('title', 'Game | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--game">
        <x-header />

        @if (session('status'))
            <x-success-message class="status-message--hero">
                {{ session('status') }}
            </x-success-message>
        @endif

        <x-progress-tracker :found="$progressFound" :total="$progressTotal" />

        <p class="instruction-copy">Found a banana? Scan the QR code to reveal your next destination!</p>

        <x-primary-button type="button" class="button-wrap">
            Open Camera to Scan
        </x-primary-button>

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
