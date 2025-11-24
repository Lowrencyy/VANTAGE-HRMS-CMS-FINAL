<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyChoose;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class WhyChooseController extends Controller
{
    /**
     * Show the CMS form for "Why Choose Us"
     */
    public function index()
    {
        // Get first record or create an empty one
        $why = WhyChoose::first();

        if (! $why) {
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
        if (! $why) {
            $why = WhyChoose::create();
        }

        // Default image path = existing one
        $imagePath = $why->background_image;

        // ================== HANDLE IMAGE UPLOAD (DIRECT TO public/) ==================
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');

            // Target folder: public/imagestorage/whychoose
            $folderPath = public_path('imagestorage/whychoose');

            // Gumawa ng folder kung wala pa
            if (! File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // DELETE OLD IMAGE IF EXISTS
            if (! empty($why->background_image) && File::exists(public_path($why->background_image))) {
                File::delete(public_path($why->background_image));
            }

            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Move new file to public/imagestorage/whychoose
            $file->move($folderPath, $filename);

            // Store relative path in DB (same style as HR/Employee)
            // e.g. imagestorage/whychoose/abc123.jpg
            $imagePath = 'imagestorage/whychoose/' . $filename;
        }
        // ======================================================================

        // Update record
        $why->update([
            'banner_title'     => $request->banner_title,
            'title'            => $request->title,
            'description'      => $request->description,
            'solution_title_1' => $request->solution_title_1,
            'solution_title_2' => $request->solution_title_2,
            'solution_title_3' => $request->solution_title_3,
            'solution_title_4' => $request->solution_title_4,
            'background_image' => $imagePath, // stays same if no new upload
        ]);

        return back()->with('success', 'Why Choose Us updated successfully!');
    }
}
