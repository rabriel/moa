@extends('layouts.app')

@section('title', 'Welcome | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--landing">
        <x-header />

        <p class="hero-copy">
            Henry &amp; James need YOUR help! Hunt down all the store clues hidden around Mall of the North.
        </p>

        <x-primary-button :href="route('register.index')" class="button-wrap button-wrap--hero">
            Let's GO!
        </x-primary-button>

        <p class="fine-print fine-print--landing text-center">Free to enter. One entry per person.</p>
    </section>
@endsection
