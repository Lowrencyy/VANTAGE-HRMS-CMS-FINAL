<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSetting extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'button_text',
        'button_link'
    ];
}