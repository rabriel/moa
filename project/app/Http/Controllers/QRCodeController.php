<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerStoreVisit;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QRCodeController extends Controller
{
    public function show(Request $request, Store $store): View|RedirectResponse
    {
        $player = Player::query()->findOrFail($request->session()->get('player_id'));
        $progressTotal = Store::query()->where('is_active', true)->count();
        $visit = PlayerStoreVisit::query()->firstOrNew([
            'player_id' => $player->id,
            'store_id' => $store->id,
        ]);

        $isDuplicateVisit = $visit->exists;

        if (! $isDuplicateVisit) {
            $visit->visited_at = now();
            $visit->save();
        }

        $progressFound = $player->visits()->count();

        if ($progressFound >= $progressTotal) {
            if (! $player->completed_at) {
                $player->forceFill([
                    'completed_at' => now(),
                ])->save();
            }

            return redirect()->route('game.complete');
        }

        return view('game.scan', [
            'player' => $player,
            'progressTotal' => $progressTotal,
            'progressFound' => $progressFound,
            'store' => $store,
            'isDuplicateVisit' => $isDuplicateVisit,
        ]);
    }
}
