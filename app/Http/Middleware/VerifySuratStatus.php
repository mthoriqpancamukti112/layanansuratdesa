<?php

namespace App\Http\Middleware;

use App\Models\SuratPenduduk;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifySuratStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $id = $request->route('id');
        $suratPenduduk = SuratPenduduk::find($id);

        if (!$suratPenduduk || $suratPenduduk->status !== 'disetujui') {
            return redirect()->route('surat.verifikasi', ['id' => $id])->with('error', 'Anda belum bisa melakukan print surat, harap tunggu acc dari admin.');
        } elseif ($user && $user->role === 'admin') {
            return $next($request);
        }
        return $next($request);
    }
}
