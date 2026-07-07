<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('player_id')) {
            return redirect()->route('game.index');
        }

        return view('home.index');
    }
}
