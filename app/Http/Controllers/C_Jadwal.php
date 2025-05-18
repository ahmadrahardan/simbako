<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class C_Jadwal extends Controller
{
    public function jadwal(Request $request)
    {
        $bulan = $request->get('bulan', now()->format('Y-m'));

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        $data = Jadwal::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulanAngka)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('user.V_Jadwal', compact('data'));
    }

    public function adminJadwal(Request $request)
    {
        $bulan = $request->get('bulan', now()->format('Y-m'));

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        $data = Jadwal::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulanAngka)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('admin.V_Jadwal', compact('data'));
    }

    public function simpan(Request $request)
    {
        $rules = [
            'topik' => 'required|string|max:64',
            'deskripsi' => 'required|string|max:500',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:64',
            'kuota' => 'required|string',
        ];

        $messages = [
            'topik.required' => 'Topik belum diisi!',
            'topik.max' => 'Topik terlalu panjang.',
            'deskripsi.required' => 'Deskripsi belum diisi!',
            'deskripsi.max' => 'Deskripsi terlalu panjang.',
            'tanggal.required' => 'Tanggal belum diisi!',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'lokasi.required' => 'Lokasi belum diisi!',
            'lokasi.max' => 'Lokasi terlalu panjang.',
            'kuota.required' => 'kuota peserta belum diisi!',
        ];

        $validated = $request->validate($rules, $messages);

        Jadwal::create([
            'user_id' => auth()->id() ?? 1,
            'topik' => $validated['topik'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'kuota' => $validated['kuota'],
        ]);

        return back()->with('success', 'Jadwal berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id,
            'edit_mode' => 1,
        ]);

        $rules = [
            'topik' => 'required|string|max:64',
            'deskripsi' => 'required|string|max:500',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:64',
            'kuota' => 'required|string',
        ];

        $messages = [
            'topik.required' => 'Topik belum diisi!',
            'topik.max' => 'Topik terlalu panjang.',
            'deskripsi.required' => 'Deskripsi belum diisi!',
            'deskripsi.max' => 'Deskripsi terlalu panjang.',
            'tanggal.required' => 'Tanggal belum diisi!',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'lokasi.required' => 'Lokasi belum diisi!',
            'lokasi.max' => 'Lokasi terlalu panjang.',
            'kuota.required' => 'kuota peserta belum diisi!',
        ];

        $validated = $request->validate($rules, $messages);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->topik = $validated['topik'];
        $jadwal->deskripsi = $validated['deskripsi'];
        $jadwal->tanggal = $validated['tanggal'];
        $jadwal->lokasi = $validated['lokasi'];
        $jadwal->kuota = $validated['kuota'];

        $jadwal->save();

        return back()->with('success', 'Jadwal berhasil diperbarui!');
    }


    public function hapus($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $jadwal->delete();

        return back()->with('success', 'Data jadwal berhasil dihapus!');
    }
}
