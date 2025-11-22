<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'motto',
        'description',
        'button_text',
        'button_link',
        'image',
    ];
}
