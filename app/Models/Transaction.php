<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan Laravel
    protected $table = 'transactions';

    // Jika tidak menggunakan timestamps otomatis (created_at, updated_at)
    public $timestamps = false;

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'total_harga',
        'bayar',
        'kembalian',
        'created_at'
    ];
}
