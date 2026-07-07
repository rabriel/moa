<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.entries.index');
        }

        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $adminEmail = (string) config('admin.email');
        $adminPasswordHash = (string) config('admin.password_hash');

        $isValid = strcasecmp($credentials['email'], $adminEmail) === 0
            && $this->passwordMatches($credentials['password'], $adminPasswordHash);

        if (! $isValid) {
            return back()
                ->withErrors(['email' => 'The provided admin credentials are incorrect.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_email', $adminEmail);

        return redirect()->route('admin.entries.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget([
            'admin_authenticated',
            'admin_email',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    protected function passwordMatches(string $plainPassword, string $storedHash): bool
    {
        if ($storedHash === '') {
            return false;
        }

        return password_verify($plainPassword, $storedHash);
    }
}
