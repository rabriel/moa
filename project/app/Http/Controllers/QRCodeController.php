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
    protected const STORE_SUCCESS_MESSAGES = [
        'ackermans' => 'Bee-do! You did it!',
        'lacoste' => 'Ba-na-na! Nice work!',
        'spec-savers' => 'Bello! You found one!',
        'baby-city' => 'Banana power! Keep going!',
        'the-fun-company' => "You're one clever Minion!",
        'expedition-north' => 'Woohoo! Another banana found!',
        'coricraft' => 'Great job, Banana Hunter!',
        'legends-barbershop' => "You're on a banana roll!",
        'clicks' => 'Bello, superstar!',
        'lovisa' => 'Minion approved!',
        'destinations-by-frasers' => 'Ooh la la! Another one found!',
        'freedom-of-movement' => 'Banana-tastic!',
        'sorbet' => 'Keep calm and go bananas!',
        'old-school' => 'Despicably good hunting!',
        'le-creuset' => 'So far, so banana!',
        'pna' => "You're crushing this hunt!",
        'crocs' => 'Banana brilliance!',
        'cell-c' => "You've got Minion magic!",
        'totalsports' => 'Another banana bites the dust!',
        'spur' => 'Bee-do! You did it!',
    ];

    public function show(Request $request, Store $store): View|RedirectResponse
    {
        $player = Player::query()->findOrFail($request->session()->get('player_id'));
        $progressTotal = Store::query()->where('is_active', true)->count();
        $visit = PlayerStoreVisit::query()->firstOrNew([
            'player_id' => $player->id,
            'store_id' => $store->id,
        ]);
        $isIntroAckermans = $store->slug === 'ackermans'
            && $request->boolean('intro')
            && ! $visit->exists
            && $player->visits()->count() === 0;

        if ($isIntroAckermans) {
            return view('game.scan', [
                'player' => $player,
                'progressTotal' => $progressTotal,
                'progressFound' => 0,
                'store' => $store,
                'isDuplicateVisit' => false,
                'showSuccessMessage' => false,
                'successMessage' => null,
            ]);
        }

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
            'showSuccessMessage' => ! $isDuplicateVisit,
            'successMessage' => self::STORE_SUCCESS_MESSAGES[$store->slug] ?? 'Bee-do! You did it!',
        ]);
    }
}
