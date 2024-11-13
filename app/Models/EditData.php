<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class EditData extends Model
{
    protected $table = 'logo'; // Nama tabel di database

    public $timestamps = false; // Nonaktifkan timestamps otomatis (created_at & updated_at)

    protected $fillable = ['nama_web']; // Kolom yang dapat diisi

    // Metode untuk menghapus ikon
    public function delete_icon()
    {
        $iconPath = public_path('img/icon/icon.png'); // Path file ikon

        if (File::exists($iconPath)) {
            File::delete($iconPath);
        }
    }

    // Metode untuk mengupload ikon baru
    public function upload_icon($file)
    {
        $filename = 'icon.png'; // Nama file ikon
        $file->move(public_path('img/icon'), $filename); // Pindahkan ke folder public/img/icon
    }

    // Metode untuk menghapus logo
    public function delete_logo()
    {
        $logoPath = public_path('img/logo/logo.png'); // Path file logo

        if (File::exists($logoPath)) {
            File::delete($logoPath);
        }
    }

    // Metode untuk mengupload logo baru
    public function upload_logo($file)
    {
        $filename = 'logo.png'; // Nama file logo
        $file->move(public_path('img/logo'), $filename); // Pindahkan ke folder public/img/logo
    }
}
