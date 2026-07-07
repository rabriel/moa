<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('player_id')) {
            return redirect()->route('game.index');
        }

        return view('registration.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:players,email'],
            'cell_phone' => ['required', 'string', 'max:30', 'unique:players,cell_phone'],
        ]);

        $request->session()->regenerate();

        $player = Player::create([
            ...$validated,
            'session_token' => $request->session()->getId(),
        ]);

        $request->session()->put('player_id', $player->id);

        return redirect()
            ->route('game.index')
            ->with('status', 'Registration complete. Start hunting for Minions!');
    }
}
