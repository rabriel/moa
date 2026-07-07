<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_id')) {
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

        $admin = Admin::query()
            ->where('email', $credentials['email'])
            ->where('is_active', true)
            ->first();

        $isValid = $admin !== null
            && $this->passwordMatches($credentials['password'], $admin->password);

        if (! $isValid) {
            return back()
                ->withErrors(['email' => 'The provided admin credentials are incorrect.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_email', $admin->email);

        return redirect()->route('admin.entries.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget([
            'admin_id',
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
