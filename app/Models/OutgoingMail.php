<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingMail extends Model
{
    protected $table = 'outgoing_mails';
    
    protected $fillable = [
        'subject',
        'recipient',
        'file_path',
        'sent_by',
    ];

    // Relasi ke Users (dikirim oleh)
    public function user()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
