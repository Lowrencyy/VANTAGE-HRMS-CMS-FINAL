<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'section_subtitle',
        'section_title',
        'need_help_title',
        'need_help_subtitle',
        'location_title',
        'location_text',
        'email_title',
        'email_text',
        'phone_title',
        'phone_text',
        'image_path',
        'map_embed',
    ];
}
