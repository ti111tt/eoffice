<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'item_id',
        'quantity',
        'subtotal'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
