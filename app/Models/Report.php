<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['title', 'content', 'category_id'];

    // Relasi ke model Category (setiap laporan dimiliki oleh satu kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
