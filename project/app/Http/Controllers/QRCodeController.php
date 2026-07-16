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
    protected const HUNT_PROGRESS_TOTAL = 20;

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
        $actualTotal = Store::query()->where('is_active', true)->count();
        $progressTotal = self::HUNT_PROGRESS_TOTAL;
        $nextStore = $this->resolveNextStore($store);
        $expectedStore = $this->resolveExpectedStore($player);
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
                'clueStore' => $store,
                'isDuplicateVisit' => false,
                'showMissedBananasMessage' => false,
                'showSuccessMessage' => false,
                'successMessage' => null,
            ]);
        }

        $isDuplicateVisit = $visit->exists;
        $showMissedBananasMessage = false;

        if (! $isDuplicateVisit && $expectedStore && $store->id !== $expectedStore->id) {
            $showMissedBananasMessage = true;

            return view('game.scan', [
                'player' => $player,
                'progressTotal' => $progressTotal,
                'progressFound' => min($player->visits()->count(), $progressTotal),
                'store' => $store,
                'clueStore' => $expectedStore,
                'isDuplicateVisit' => false,
                'showMissedBananasMessage' => true,
                'showSuccessMessage' => false,
                'successMessage' => null,
            ]);
        }

        if (! $isDuplicateVisit) {
            $visit->visited_at = now();
            $visit->save();
        }

        $actualFound = $player->visits()->count();
        $progressFound = min($actualFound, $progressTotal);

        if ($actualFound >= $actualTotal) {
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
            'clueStore' => $nextStore,
            'isDuplicateVisit' => $isDuplicateVisit,
            'showMissedBananasMessage' => $showMissedBananasMessage,
            'showSuccessMessage' => ! $isDuplicateVisit && ! $showMissedBananasMessage,
            'successMessage' => self::STORE_SUCCESS_MESSAGES[$store->slug] ?? 'Bee-do! You did it!',
        ]);
    }

    protected function resolveNextStore(Store $store): ?Store
    {
        return Store::query()
            ->where('is_active', true)
            ->where('sort_order', '>', $store->sort_order)
            ->orderBy('sort_order')
            ->first();
    }

    protected function resolveExpectedStore(Player $player): ?Store
    {
        $completedVisits = $player->visits()->count();
        $expectedSortOrder = $completedVisits + 1;

        return Store::query()
            ->where('is_active', true)
            ->where('sort_order', $expectedSortOrder)
            ->first();
    }
}
