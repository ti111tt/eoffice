<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingMail extends Model
{
    protected $table = 'incoming_mails';
    
    protected $fillable = [
        'subject',
        'sender',
        'file_path',
        'received_by',
    ];

    // Relasi ke Users (diterima oleh)
    public function user()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
