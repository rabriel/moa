<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $player = $this->resolvePlayer($request);
        $progressTotal = Store::query()->where('is_active', true)->count();
        $progressFound = $player->visits()->count();

        return view('game.index', [
            'player' => $player,
            'progressTotal' => $progressTotal,
            'progressFound' => $progressFound,
        ]);
    }

    public function complete(Request $request): View
    {
        $player = $this->resolvePlayer($request);
        $progressTotal = Store::query()->where('is_active', true)->count();
        $progressFound = min($player->visits()->count(), $progressTotal);

        if ($progressFound >= $progressTotal && ! $player->completed_at) {
            $player->forceFill([
                'completed_at' => now(),
            ])->save();
        }

        return view('game.complete', [
            'player' => $player,
            'progressTotal' => $progressTotal,
            'progressFound' => $progressFound,
        ]);
    }

    protected function resolvePlayer(Request $request): Player
    {
        return Player::query()->findOrFail($request->session()->get('player_id'));
    }
}
