<?php 
// app/Models/Upload.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Upload extends Model
{
    protected $table = 'media'; // Your media table
    
    protected $fillable = ['id_user', 'media_type', 'media_path', 'description', 'created_at'];

    public $timestamps = false;

    // Save media data into the 'media' table
    public function saveMedia($data)
    {
        return self::create($data); // 'create()' inserts the data
    }

    // Upload the file to the specified directory
    public function uploadFile($file)
    {
        $fileName = $file->getClientOriginalName(); // Get the original file name
        $file->move(public_path('images'), $fileName); // Move to 'public/img' directory

        return $fileName; // Return the name of the file for further use
    }

    // Function to get all media with user information (if needed)
    public function getAllMediaWithUser()
    {
        return DB::table('media')
            ->join('users', 'users.id_user', '=', 'media.id_user')
            ->select('media.*', 'users.nama_lengkap')
            ->orderBy('media.created_at', 'desc')
            ->get();
    }
}
