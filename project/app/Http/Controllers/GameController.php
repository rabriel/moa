<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    protected const HUNT_PROGRESS_TOTAL = 20;
    protected const FINAL_PROGRESS_TOTAL = 20;

    public function index(Request $request): View
    {
        $player = $this->resolvePlayer($request);
        $progressTotal = self::HUNT_PROGRESS_TOTAL;
        $progressFound = min($player->visits()->count(), $progressTotal);

        return view('game.index', [
            'player' => $player,
            'progressTotal' => $progressTotal,
            'progressFound' => $progressFound,
        ]);
    }

    public function complete(Request $request): View
    {
        $player = $this->resolvePlayer($request);
        $progressTotal = self::FINAL_PROGRESS_TOTAL;
        $progressFound = self::FINAL_PROGRESS_TOTAL;

        if ($player->visits()->count() >= self::FINAL_PROGRESS_TOTAL && ! $player->completed_at) {
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
