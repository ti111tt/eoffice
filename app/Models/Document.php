<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    
    protected $fillable = [
        'title',
        'category',
        'file_path',
        'created_by',
    ];

    // Relasi ke Users (dibuat oleh)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
