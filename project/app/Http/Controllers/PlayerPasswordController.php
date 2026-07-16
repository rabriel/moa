<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PlayerPasswordController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('player_id')) {
            return redirect()->route('game.index');
        }

        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'cell_phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $player = Player::query()
            ->where('email', $validated['email'])
            ->where('cell_phone', $validated['cell_phone'])
            ->first();

        if (! $player) {
            return back()
                ->withErrors(['email' => 'We could not match those details to an existing entry.'])
                ->onlyInput('email', 'cell_phone');
        }

        $player->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        return redirect()
            ->route('login')
            ->with('status', 'Your password has been updated. You can log in now.');
    }
}
