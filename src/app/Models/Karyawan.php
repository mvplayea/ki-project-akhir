<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jabatan',
        'email',
        'tanggal_masuk',
        'status_kerja',
    ];

    protected static function boot() 
        parent::boot();

        static::creating(function ($karyawan){
            if(empty($karyawan->api_token)){
                $gaji->api_token = Str::random(5);
            }
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}