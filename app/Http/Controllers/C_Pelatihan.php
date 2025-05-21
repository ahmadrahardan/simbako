<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Peserta;

class C_Pelatihan extends Controller
{
    // public function pelatihan(Request $request)
    // {
    //     $bulan = $request->get('bulan', now()->format('Y-m'));

    //     $tahun = substr($bulan, 0, 4);
    //     $bulanAngka = substr($bulan, 5, 2);

    //     // Data pelatihan bulan tertentu (untuk fitur filter utama)
    //     $data = Jadwal::whereYear('tanggal', $tahun)
    //         ->whereMonth('tanggal', $bulanAngka)
    //         ->orderBy('tanggal', 'asc')
    //         ->get();

    //     // User login
    //     $userId = auth()->id();

    //     // Ambil semua jadwal yang user ini pernah daftarkan (riwayat lengkap, tanpa filter bulan)
    //     $riwayat = Jadwal::whereHas('pendaftaran', function ($q) use ($userId) {
    //         $q->where('user_id', $userId);
    //     })
    //         ->orderBy('tanggal', 'desc')
    //         ->get();

    //     return view('user.V_Pelatihan', compact('data', 'riwayat'));
    // }
    public function pelatihan(Request $request)
    {
        // Ambil request bulan, default ke 'terbaru'
        $bulan = $request->get('bulan', 'terbaru');

        // Query awal
        $query = Jadwal::query();

        if ($bulan === 'terbaru') {
            // Jika pilih 'terbaru', ambil 5 data pelatihan terbaru
            $query->orderBy('tanggal', 'desc')->limit(5);
        } else {
            // Ambil pelatihan berdasarkan bulan & tahun
            $tahun = substr($bulan, 0, 4);
            $bulanAngka = substr($bulan, 5, 2);
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulanAngka)
                ->orderBy('tanggal', 'asc');
        }

        $data = $query->get();

        // Ambil riwayat pendaftaran pelatihan user yang login
        $userId = auth()->id();
        $riwayat = Jadwal::whereHas('pendaftaran', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user.V_Pelatihan', compact('data', 'riwayat'));
    }
}
