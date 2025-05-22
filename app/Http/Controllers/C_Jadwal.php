<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class C_Jadwal extends Controller
{
    public function jadwal(Request $request)
    {
        $bulan = $request->get('bulan', 'terbaru');

        $query = Jadwal::query();

        if ($bulan === 'terbaru') {
            $query->orderBy('tanggal', 'desc')->limit(5);
        } else {
            $tahun = substr($bulan, 0, 4);
            $bulanAngka = substr($bulan, 5, 2);

            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulanAngka)
                ->orderBy('tanggal', 'asc');
        }

        $data = $query->get();

        $userId = auth()->id();
        $sudahDaftar = \App\Models\Pendaftaran::where('user_id', $userId)
            ->pluck('jadwal_id')
            ->toArray();

        return view('user.V_Jadwal', compact('data', 'sudahDaftar'));
    }


    public function adminJadwal(Request $request)
    {
        $bulan = $bulan = $request->get('bulan', 'terbaru');

        $query = Jadwal::query();

        if ($bulan === 'terbaru') {

            $query->orderBy('tanggal', 'desc')->limit(5);
        } else {
            $tahun = substr($bulan, 0, 4);
            $bulanAngka = substr($bulan, 5, 2);
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulanAngka)
                ->orderBy('tanggal', 'asc');
        }

        $data = $query->get();

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

    public function daftar(Request $request)
    {
        $rules = [
            'jadwal_id' => 'required|exists:jadwal,id',
            'pendaftar_1' => 'nullable|string|max:64',
            'pendaftar_2' => 'nullable|string|max:64',
            'pendaftar_3' => 'nullable|string|max:64',
            'pendaftar_4' => 'nullable|string|max:64',
            'pendaftar_5' => 'nullable|string|max:64',
        ];

        $messages = [
            'jadwal_id.required' => 'ID jadwal tidak ditemukan.',
            'jadwal_id.exists' => 'Jadwal tidak valid.',
            'pendaftar_1.max' => 'Nama terlalu panjang.',
            'pendaftar_2.max' => 'Nama terlalu panjang.',
            'pendaftar_3.max' => 'Nama terlalu panjang.',
            'pendaftar_4.max' => 'Nama terlalu panjang.',
            'pendaftar_5.max' => 'Nama terlalu panjang.',
        ];

        $validated = $request->validate($rules, $messages);

        // Validasi minimal satu nama diisi
        if (
            empty($validated['pendaftar_1']) &&
            empty($validated['pendaftar_2']) &&
            empty($validated['pendaftar_3']) &&
            empty($validated['pendaftar_4']) &&
            empty($validated['pendaftar_5'])
        ) {
            return back()
                ->withErrors(['pendaftar_1' => 'Belum ada nama yang didaftarkan!'])
                ->withInput();
        }

        // Simpan ke tabel `pendaftaran`
        $pendaftaran = Pendaftaran::create([
            'user_id' => auth()->id(),
            'jadwal_id' => $validated['jadwal_id'],
        ]);

        // Simpan peserta ke tabel `peserta`
        foreach (range(1, 5) as $i) {
            $nama = $validated["pendaftar_$i"] ?? null;
            if ($nama) {
                Peserta::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'nama' => $nama,
                ]);
            }
        }

        return back()->with('success', 'Berhasil mendaftar!');
    }
}
