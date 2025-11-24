<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyChoose;
use Illuminate\Support\Facades\Storage;

class WhyChooseController extends Controller
{
    /**
     * Show the CMS form for "Why Choose Us"
     */
    public function index()
    {
        // Get first record or create an empty one
        $why = WhyChoose::first();

        if (!$why) {
            $why = WhyChoose::create();
        }

        return view('CMS.whychoose', compact('why'));
    }

    /**
     * Update the "Why Choose Us" content
     */
    public function update(Request $request)
    {
        $request->validate([
            'banner_title'     => 'nullable|string|max:255',
            'title'            => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'solution_title_1' => 'nullable|string|max:255',
            'solution_title_2' => 'nullable|string|max:255',
            'solution_title_3' => 'nullable|string|max:255',
            'solution_title_4' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
        ]);

        // Make sure we always have a record
        $why = WhyChoose::first();
        if (!$why) {
            $why = WhyChoose::create();
        }

        // Default image path = existing one
        $imagePath = $why->background_image;

        // Handle image upload
        if ($request->hasFile('background_image')) {

            // Delete old image if exists on "public" disk
            if ($why->background_image && Storage::disk('public')->exists($why->background_image)) {
                Storage::disk('public')->delete($why->background_image);
            }

            // Store new file in "public" disk under imagestorage/whychoose
            // Result stored in DB: "imagestorage/whychoose/filename.jpg"
            $imagePath = $request->file('background_image')
                                 ->store('imagestorage/whychoose', 'public');
        }

        // Update record
        $why->update([
            'banner_title'     => $request->banner_title,
            'title'            => $request->title,
            'description'      => $request->description,
            'solution_title_1' => $request->solution_title_1,
            'solution_title_2' => $request->solution_title_2,
            'solution_title_3' => $request->solution_title_3,
            'solution_title_4' => $request->solution_title_4,
            'background_image' => $imagePath, // e.g. "imagestorage/whychoose/xxx.jpg"
        ]);

        return back()->with('success', 'Why Choose Us updated successfully!');
    }
}
