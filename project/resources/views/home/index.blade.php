@extends('layouts.app')

@section('title', 'Welcome | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--landing">
        <x-header />

        <div class="hero-copy hero-copy--landing">
            <p class="hero-copy__line">Find all</p>
            <p class="hero-copy__line hero-copy__line--highlight">20 hidden bananas</p>
            <p class="hero-copy__line">in participating store windows.</p>
        </div>

        <div class="hero-subcopy">
            <p>Scan each QR code, and complete the hunt</p>
            <p>to stand a chance to</p>
            <p class="hero-copy__line hero-copy__line--highlight" style="color:var(--brand-yellow)!important;">WIN a R2 500</p>
            <p>Mall of the North gift card!</p>
        </div>

        <x-primary-button :href="route('register.index')" class="button-wrap button-wrap--hero">
            LET THE HUNT BEGIN!
        </x-primary-button>

        <div class="legal-copy legal-copy--landing">
            <p class="fine-print fine-print--landing text-center">Free to enter. Participation is free. Limited to one entry per person.</p>
            <p class="fine-print text-center">Competition ends Fri 31 July. <a href="#" class="legal-inline-link">T's &amp; C's</a> apply.</p>
        </div>
    </section>
@endsection
