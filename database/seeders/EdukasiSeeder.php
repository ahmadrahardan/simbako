<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Edukasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topiks = [
            'Pengenalan Varietas Tembakau dan Kesesuaian Tempat Tumbuhnya',
            'Dampak Penggunaan Pupuk Kimia Berlebihan pada Tembakau',
            'Waktu Transplanting yang Baik pada Tembakau',
            'Teknik Pembibitan Tembakau yang Tepat',
            'Faktor-faktor yang Memengaruhi Pertumbuhan Tembakau',
        ];

        foreach ($topiks as $topik) {
            Edukasi::create([
                'topik' => $topik,
                'user_id' => 1,
                'slug' => Str::slug($topik),
                'thumbnail' => 'dummy/cigar.png',
                'konten' => 'dummy/tembakau.txt',
                'link' => 'https://youtu.be/lqIbNTPyqaI?si=Epiq1bbreZAfNW8U',
            ]);
        }
    }
}
