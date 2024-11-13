<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model

{
    protected $table = 'logo'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'logo_id';
    public $timestamps = false; // Jika tidak menggunakan kolom created_at dan updated_at
}

