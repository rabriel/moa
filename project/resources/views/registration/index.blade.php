@extends('layouts.app')

@section('title', 'Register | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--register">
        <x-header />

        @if ($errors->any())
            <x-error-message>
                Please fix the highlighted fields and try again.
            </x-error-message>
        @endif

        <form class="entry-form" method="POST" action="{{ route('register.store') }}" novalidate>
            @csrf

            <div class="mb-4">
                <label class="form-label" for="name">Name</label>
                <input
                    id="name"
                    name="name"
                    class="form-control-game @error('name') is-invalid @enderror"
                    type="text"
                    value="{{ old('name') }}"
                    placeholder="your name"
                    required
                >
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label" for="surname">Surname</label>
                <input
                    id="surname"
                    name="surname"
                    class="form-control-game @error('surname') is-invalid @enderror"
                    type="text"
                    value="{{ old('surname') }}"
                    placeholder="your surname"
                    required
                >
                @error('surname')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label" for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    class="form-control-game @error('email') is-invalid @enderror"
                    type="email"
                    value="{{ old('email') }}"
                    placeholder="your email"
                    required
                >
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label class="form-label" for="cell_phone">Cellphone</label>
                <input
                    id="cell_phone"
                    name="cell_phone"
                    class="form-control-game @error('cell_phone') is-invalid @enderror"
                    type="tel"
                    value="{{ old('cell_phone') }}"
                    placeholder="your cell number"
                    required
                >
                @error('cell_phone')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <x-primary-button type="submit" class="button-wrap">I'M READY!</x-primary-button>
        </form>

        <p class="fine-print text-center">Free to enter. One entry per person.</p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
    </section>
@endsection
