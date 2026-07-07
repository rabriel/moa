<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminId = $request->session()->get('admin_id');

        if (! $adminId || ! Admin::query()->whereKey($adminId)->where('is_active', true)->exists()) {
            $request->session()->forget([
                'admin_id',
                'admin_email',
            ]);

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
