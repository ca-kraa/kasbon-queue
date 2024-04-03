<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasbon extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_diajukan', 'tanggal_disetujui', 'pegawai_id', 'total_kasbon'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kasbon) {
            $kasbon->tanggal_diajukan = now();
        });
    }
}
