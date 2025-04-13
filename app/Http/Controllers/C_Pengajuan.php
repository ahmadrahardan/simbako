<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class C_Pengajuan extends Controller
{
    public function pengajuan()
    {
        $data = Pengajuan::where('status', 'Proses')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.V_Pengajuan', compact('data'));
    }

    public function adminPengajuan()
    {
        $data = Pengajuan::orderBy('created_at', 'desc')->get();

        $data = Pengajuan::with('user')->latest()->get();

        return view('admin.V_Pengajuan', compact('data'));
    }

    public function simpan(Request $request)
    {
        $rules = [
            'topik' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ];

        $messages = [
            'topik.required' => 'Topik belum diisi!',
            'topik.max' => 'Topik terlalu panjang (maks 255 karakter).',
            'dokumen.required' => 'Dokumen harus diunggah!',
            'dokumen.file' => 'Format dokumen tidak valid.',
            'dokumen.mimes' => 'Dokumen harus dalam format PDF, DOC, atau DOCX.',
            'dokumen.max' => 'Ukuran dokumen maksimal 10MB.',
        ];

        $validated = $request->validate($rules, $messages);

        $filePath = $request->file('dokumen')->store('dokumen_pengajuan', 'public');

        Pengajuan::create([
            'user_id' => Auth::id(),
            'topik' => $validated['topik'],
            'dokumen' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Disetujui,Ditolak']);
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return response()->json(['message' => 'Status diperbarui']);
    }
}
