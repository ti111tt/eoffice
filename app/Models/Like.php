<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';  // Nama tabel likes

    // Relasi ke model Media
    public function media()
    {
        return $this->belongsTo(Mediaa::class, 'media_id');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
