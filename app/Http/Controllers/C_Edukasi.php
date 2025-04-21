<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Edukasi;

class C_Edukasi extends Controller
{
    public function edukasi()
    {
        $data = Edukasi::latest()->get();
        return view('user.V_Edukasi', compact('data'));
    }

    public function adminEdukasi()
    {
        $data = Edukasi::latest()->get();
        return view('admin.V_Edukasi', compact('data'));
    }

    public function konten($slug)
    {
        $edukasi = Edukasi::where('slug', $slug)->firstOrFail();
        return view('master.V_KontenEdukasi', compact('edukasi'));
    }

    public function simpan(Request $request)
    {
        $rules = [
            'topik' => 'required|string|max:255',
            'thumbnail' => 'required|image|max:2048',
            'konten' => 'required|file|mimes:txt|max:10240',
            'link' => 'nullable|url',
        ];

        $messages = [
            'topik.required' => 'Topik belum diisi!',
            'topik.max' => 'Topik terlalu panjang.',
            'thumbnail.required' => 'Thumbnail belum diunggah!',
            'thumbnail.image' => 'File thumbnail harus berupa gambar!',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'konten.required' => 'File belum diunggah!',
            'konten.file' => 'Format file tidak valid.',
            'konten.mimes' => 'File harus dalam format txt.',
            'konten.max' => 'Ukuran file maksimal 10MB.',
            'link.url' => 'Link YouTube harus berupa URL yang valid.',
        ];

        $validated = $request->validate($rules, $messages);

        // Simpan file
        $thumbnailPath = $request->file('thumbnail')->storeAs(
            'edukasi',
            Str::random(10) . '.' . $request->file('thumbnail')->getClientOriginalExtension(),
            'public'
        );

        $dokumenPath = $request->file('konten')->storeAs(
            'edukasi',
            Str::random(10) . '.' . $request->file('konten')->getClientOriginalExtension(),
            'public'
        );

        Edukasi::create([
            'user_id' => auth()->id() ?? 1,
            'topik' => $validated['topik'],
            'slug' => Str::slug($validated['topik']),
            'thumbnail' => 'storage/' . $thumbnailPath,
            'konten' => 'storage/' . $dokumenPath,
            'link' => $validated['link'] ?? null,
        ]);

        return back()->with('success', 'Edukasi berhasil ditambahkan!');
    }
}
