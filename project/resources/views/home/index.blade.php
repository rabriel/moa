@extends('layouts.app')

@section('title', 'Welcome | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--landing">
        <x-header />

        <p class="hero-copy">
            Find all 20 hidden bananas in participating store windows. Scan each QR code, and complete the hunt to stand a chance to WIN a R2 500 Mall of the North gift card!
        </p>

        <x-primary-button :href="route('register.index')" class="button-wrap button-wrap--hero">
            LET THE HUNT BEGIN!
        </x-primary-button>

        <p class="fine-print fine-print--landing text-center">Participation is free. Limited to one entry per person. Competition ends Fri 31 July. T's &amp; C's apply.</p>
    </section>
@endsection
