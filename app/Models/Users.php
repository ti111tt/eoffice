<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Nama tabel sesuai dengan database

    protected $primaryKey = 'id_user'; // Primary key dari tabel

    // Kolom-kolom yang bisa diisi
    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'level',
        'create_at',
        'create_by',
        'update_at',
        'update_by',
        'delete_at',
        'delete_by'
    ];

    // Jika Anda tidak menggunakan timestamp bawaan Laravel
    public $timestamps = false;

    // Jika Anda ingin melakukan hashing password secara otomatis
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
