@extends('layouts.app')

@section('title', 'Login | Mall of the North QR Hunt')

@section('content')
    <section class="screen-card screen-card--register">
        <x-header />

        @if (session('status'))
            <x-success-message>
                {{ session('status') }}
            </x-success-message>
        @endif

        @if ($errors->any())
            <x-error-message>
                Please check your login details and try again.
            </x-error-message>
        @endif

        <form class="entry-form" method="POST" action="{{ route('login.store') }}" novalidate>
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

            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    class="form-control-game @error('password') is-invalid @enderror"
                    type="password"
                    placeholder="your password"
                    required
                >
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <p class="auth-helper-link"><a href="{{ route('password.request') }}">Forgot password?</a></p>

            <x-primary-button type="submit" class="button-wrap">LOG IN</x-primary-button>
        </form>

        <p class="fine-print text-center">Already entered before? Use your email and password to continue the hunt.</p>
        <p class="auth-helper-link auth-helper-link--bottom"><a href="{{ route('register.index') }}">Need to register first?</a></p>
        <p class="terms-link-wrap"><a href="#" class="terms-link">Terms &amp; Conditions</a></p>
    </section>
@endsection
