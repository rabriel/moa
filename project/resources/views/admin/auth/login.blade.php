@extends('layouts.admin')

@section('title', 'Admin Login | Mall of the North QR Hunt')

@section('content')
    <section class="admin-card admin-card--auth">
        <h1 class="admin-title">Admin Login</h1>
        <p class="admin-subtitle">Sign in to view and export competition entries.</p>

        @if ($errors->any())
            <div class="admin-alert admin-alert--error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="admin-form">
            @csrf

            <div class="admin-field">
                <label for="email" class="admin-label">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="admin-input"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="admin-field">
                <label for="password" class="admin-label">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="admin-input"
                    required
                >
            </div>

            <button type="submit" class="admin-button">Login</button>
        </form>
    </section>
@endsection
