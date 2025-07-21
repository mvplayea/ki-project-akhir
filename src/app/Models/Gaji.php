<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'periode',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
        'tanggal_input',
    ];

    protected static function boot() 
        parent::boot();

        static::creating(function ($gaji){
            if(empty($gaji->api_token)){
                $gaji->api_token = Str::random(5);
            }
        });
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}