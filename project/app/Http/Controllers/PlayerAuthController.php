<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PlayerAuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('player_id')) {
            return redirect()->route('game.index');
        }

        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $player = Player::query()
            ->where('email', $credentials['email'])
            ->first();

        if (! $player || ! $player->password || ! Hash::check($credentials['password'], $player->password)) {
            return back()
                ->withErrors(['email' => 'These login details do not match our records.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('player_id', $player->id);

        $player->forceFill([
            'session_token' => $request->session()->getId(),
        ])->save();

        return redirect()->route('game.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('player_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
