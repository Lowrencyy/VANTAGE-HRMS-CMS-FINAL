<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionVision extends Model
{
    protected $fillable = [
        'title',
        'description',
        'mission',
        'vision',
          'image',
    ];
}
