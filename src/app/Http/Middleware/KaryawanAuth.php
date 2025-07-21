<?php

namespace App\Http\Middleware;

use App\Models\Karyawan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KaryawanAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $karyawan = Karyawan::where('api_token', $token)->first();
        if (!$karyawan) {
            return response()->json([
                'message' => 'Unathorized'
            ], 401);
        }
        $request->merge(['authenticated_karyawan' => $karyawan]);
        return $next($request);
    }
}
