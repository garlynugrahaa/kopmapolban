<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_log extends Model
{
    use HasFactory;

    public $table = 'activity_log'; // dilakukan seperti ini agar tidak menjadi plural

    protected $fillable = [
        'log_name',
        'description',
        'event',
        'causer_id'
    ];
}
