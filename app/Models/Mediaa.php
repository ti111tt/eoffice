<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Mediaa extends Model
{
    protected $table = 'media'; // Your media table
    
    protected $fillable = ['id_user', 'media_type', 'media_path', 'description', 'created_at'];

    // Function to get media with user information
    public function getAllMediaWithUser()
    {
        return DB::table('media')
            ->join('users', 'users.id_user', '=', 'media.id_user') // Make sure this matches your database
            ->select('media.*', 'users.nama_lengkap')
            ->orderBy('media.created_at', 'desc')
            ->get();
    }
    

    // Function to get like count for a specific media
    public function getLikeCount($mediaId)
    {
        return DB::table('likes')
            ->where('media_id', $mediaId)
            ->count();
    }

    // Function to check if a user has liked a specific media
    public function checkIfLiked($mediaId, $userId)
    {
        return DB::table('likes')
            ->where('media_id', $mediaId)
            ->where('id_user', $userId)
            ->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'media_id');
    }
    protected $media = 'media';  // Define the table name if it's not following Laravel conventions

    // Define the fields that can be mass-assigned
 

    // Save media data into the 'media' table
    public function saveMedia($data)
    {
        return self::create($data); // 'create()' inserts the data
    }

    // Upload the file to the specified directory
    public function upload($file)
    {
        $imageName = $file->getClientOriginalName(); // Get the original file name
        $filePath = $file->storeAs('public/img', $imageName); // Move to 'public/img' directory

        return $imageName; // Return the name of the file for further use
    }

}
