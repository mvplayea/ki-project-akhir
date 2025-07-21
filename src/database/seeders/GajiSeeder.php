<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Gaji;
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $karyawan = Karyawan::first();

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'periode' => '2025-06',
            'gaji_pokok' => 5000000,
            'tunjangan' => 500000,
            'potongan' => 200000,
            'total_gaji' => 5300000,
            'tanggal_input' => now(),
        ]);

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'periode' => '2025-05',
            'gaji_pokok' => 5000000,
            'tunjangan' => 400000,
            'potongan' => 150000,
            'total_gaji' => 5250000,
            'tanggal_input' => now()->subMonth(),
                
        ]);
    }
}
