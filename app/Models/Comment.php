<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function media()
    {
        return $this->belongsTo(Mediaa::class, 'media_id');
    }
}
