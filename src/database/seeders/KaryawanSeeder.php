<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\User;
class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Karyawan Satu',
            'email' => 'karyawan@example.com',
            'password' => bcrypt('password'),
            'role' => 'karyawan',
        ]);

        Karyawan::create([
            'user_id' => $user->id,
            'nama' => 'Karyawan Satu',
            'nip' => 'EMP001',
            'jabatan' => 'Staff IT',
            'email' => 'karyawan@example.com',
            'tanggal_masuk' => now()->subYears(2),
            'status_kerja' => 'Tetap',
                
        ]);
    }


}
