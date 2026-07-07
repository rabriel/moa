<?php

namespace App\Http\Middleware;

use App\Models\Player;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePlayerRegistered
{
    public function handle(Request $request, Closure $next): Response
    {
        $playerId = $request->session()->get('player_id');

        if (! $playerId || ! Player::query()->whereKey($playerId)->exists()) {
            $request->session()->forget('player_id');

            return redirect()->route('register.index');
        }

        return $next($request);
    }
}
