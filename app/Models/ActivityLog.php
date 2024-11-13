<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity'; // The name of your table
    public $timestamps = false; // Disable Laravel's automatic timestamps

    protected $fillable = ['activity', 'timestamp']; // Fields that can be mass-assigned
}
