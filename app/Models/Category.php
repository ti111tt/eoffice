<?PHP
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['name'];

    // Relasi ke model Report (satu kategori memiliki banyak laporan)
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
