<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class AdminEntryController extends Controller
{
    public function index(): View
    {
        $entries = Player::query()
            ->withCount('visits')
            ->with(['stores' => fn ($query) => $query->orderBy('sort_order')])
            ->latest()
            ->paginate(25);

        return view('admin.entries.index', [
            'entries' => $entries,
            'entryCount' => Player::query()->count(),
            'completedCount' => Player::query()->whereNotNull('completed_at')->count(),
        ]);
    }

    public function export(): Response
    {
        $entries = Player::query()
            ->withCount('visits')
            ->with(['stores' => fn ($query) => $query->orderBy('sort_order')])
            ->latest()
            ->get();

        $html = view('admin.entries.export', [
            'entries' => $entries,
        ])->render();

        $filename = 'moa-entries-'.now()->format('Y-m-d-His').'.xls';

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
