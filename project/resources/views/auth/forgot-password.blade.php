@extends('layouts.app')

@section('title', 'Reset Password | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--register">
        <x-header />

        @if ($errors->any())
            <x-error-message>
                Please check your details and try again.
            </x-error-message>
        @endif

        <p class="fine-print text-center auth-intro-copy">Enter the email and cellphone used for your entry, then choose a new password.</p>

        <form class="entry-form" method="POST" action="{{ route('password.store') }}" novalidate>
            @csrf

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

            <div class="mb-4">
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

            <div class="mb-4">
                <label class="form-label" for="password">New Password</label>
                <input
                    id="password"
                    name="password"
                    class="form-control-game @error('password') is-invalid @enderror"
                    type="password"
                    placeholder="new password"
                    required
                >
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control-game"
                    type="password"
                    placeholder="confirm password"
                    required
                >
            </div>

            <x-primary-button type="submit" class="button-wrap">RESET PASSWORD</x-primary-button>
        </form>

        <p class="auth-helper-link auth-helper-link--bottom"><a href="{{ route('login') }}">Back to login</a></p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
    </section>
@endsection
