<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin Simbako',
            'username' => 'adminsimbako',
            'email' => 'disperindag@jemberkab.go.id',
            'password' => Hash::make('admin123'),
            'telepon' => '(0331)334497',
            'siinas' => null,
            'kbli' => null,
            'alamat' => 'Jl. Kalimantan No. 71, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'verifikasi' => true,
        ]);

        User::create([
            'nama' => 'BIN Cigar',
            'username' => 'bincigar',
            'email' => 'bincigar@gmail.com',
            'password' => Hash::make('user1234'),
            'telepon' => '081272030617',
            'siinas' => '12345678901234567',
            'kbli' => '12345',
            'alamat' => 'Jl. Brawijaya No. 3, Kec. Sukorambi, Kabupaten Jember, Jawa Timur 68151',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'verifikasi' => true,
        ]);

        User::create([
            'nama' => 'Besuki Raya Cigar',
            'username' => 'besukirayacigar',
            'email' => 'besukiraya@gmail.com',
            'password' => Hash::make('user4321'),
            'telepon' => '081272030614',
            'siinas' => '12345678901234569',
            'kbli' => '12344',
            'alamat' => 'Jl. Hayam Wuruk No. 139, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'verifikasi' => true,
        ]);

        User::create([
            'nama' => 'Villiger Cigars',
            'username' => 'villigercigars',
            'email' => 'villigercigars@gmail.com',
            'password' => Hash::make('user5678'),
            'telepon' => '081272030617',
            'siinas' => '12345678901234568',
            'kbli' => '12346',
            'alamat' => 'Jl. Wolter Monginsidi No. 888 A, Kec. Ajung, Kabupaten Jember, Jawa Timur 68175',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'verifikasi' => false,
        ]);
    }
}

