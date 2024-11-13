<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';  // Nama tabel di database Anda
    protected $primaryKey = 'id_user';  // Primary key dari tabel

    // Fields yang bisa diisi
    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'level'
    ];

    // Sesuaikan nama kolom untuk timestamps
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    // Otomatis hash password sebelum disimpan
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = md5($password);
    }
}
