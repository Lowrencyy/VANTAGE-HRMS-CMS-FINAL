<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyChoose;
use Illuminate\Support\Facades\Storage;

class WhyChooseController extends Controller
{
    public function index()
    {
        $why = WhyChoose::first();

        if (!$why) {
            $why = WhyChoose::create();
        }

        return view('CMS.whychoose', compact('why'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'banner_title' => 'nullable|string|max:255',
            'title'        => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'solution_title_1' => 'nullable|string|max:255',
            'solution_title_2' => 'nullable|string|max:255',
            'solution_title_3' => 'nullable|string|max:255',
            'solution_title_4' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',
        ]);

        $why = WhyChoose::first();

        // handle image upload
        if ($request->hasFile('background_image')) {

            if ($why->background_image && Storage::exists($why->background_image)) {
                Storage::delete($why->background_image);
            }

            $imagePath = $request->file('background_image')->store('public/imagestorage/whychoose');
        } else {
            $imagePath = $why->background_image;
        }

        $why->update([
            'banner_title' => $request->banner_title,
            'title'        => $request->title,
            'description'  => $request->description,
            'solution_title_1' => $request->solution_title_1,
            'solution_title_2' => $request->solution_title_2,
            'solution_title_3' => $request->solution_title_3,
            'solution_title_4' => $request->solution_title_4,
            'background_image' => $imagePath,
        ]);

        return back()->with('success', 'Why Choose Us updated successfully!');
    }
}
