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
    public function handle(Request $request, Closure $next, ...$divisiIds): Response
    {
        $user = Auth::user();

        if ($user->level_user == 'SUPERADMIN') {
            return $next($request);
        }

        if (!$user->karyawanHasDivision()->exists()) {
            return redirect()->route('dashboard')->with('message', 'Anda harus memilih divisi terlebih dahulu');
        }

        // Check if the user belongs to any of the specified divisions
        foreach ($divisiIds as $divisiId) {
            if ($user->karyawanHasDivision()->where('user_id', $user->id)->where('divisi_id', $divisiId)->exists()) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard')->with('message', 'Anda tidak memiliki akses ke bagian ini');
    }
}