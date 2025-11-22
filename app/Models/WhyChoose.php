<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChoose extends Model
{
    protected $table = 'why_choose';

    protected $fillable = [
        'background_image',
        'banner_title',
        'title',
        'description',
        'solution_title_1',
        'solution_title_2',
        'solution_title_3',
        'solution_title_4'
    ];
}
