<?php

// app/Models/Objective.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    // Define the fillable fields (to allow mass assignment)
    protected $fillable = [
        'title',
        'description',
        'image', // Add image to fillable properties
    ];

    // Optionally, you can create a helper method to handle image uploads
    public static function uploadImage($image)
    {
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
            return 'images/' . $imageName;
        }
        return null;
    }
}
