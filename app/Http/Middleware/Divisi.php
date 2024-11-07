<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Divisi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $divisiId): Response
    {
        $user = Auth::user();

        if ($user->level_user === "SUPERADMIN") {
            return $next($request);
        }
    
        // Allow access if the user belongs to the specified division
        // if ($user->karyawanHasDivision()->where('divisis.id', $divisiId)->exists()) {
        //     return $next($request);
        // }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}
