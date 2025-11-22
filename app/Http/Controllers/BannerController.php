<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroBanner;

class BannerController extends Controller
{
    /**
     * Show the banner edit page
     */
    public function index()
    {
        // Always ensure there is 1 record
        $banner = HeroBanner::first();

        if (!$banner) {
            $banner = HeroBanner::create([
                'title'        => '',
                'subtitle'     => '',
                'motto'        => '',
                'description'  => '',
                'button_text'  => '',
                'button_link'  => '',
                'image'        => '',
            ]);
        }

        return view('CMS.banner', compact('banner'));
    }

    /**
     * Update the banner details
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'required|string|max:255',
            'motto'        => 'nullable|string|max:255',
            'description'  => 'required|string',
            'button_text'  => 'nullable|string|max:255',
            'button_link'  => 'nullable|string|max:255',
            'image'        => 'nullable|image|max:3000',
        ]);

        $banner = HeroBanner::first();

        if (!$banner) {
            return redirect()->back()->with('error', 'Banner record not found.');
        }

        // ============================
        // IMAGE UPLOAD TO public/ImageStorage/banner
        // ============================
        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $file       = $request->file('image');
            $fileName   = time() . '_' . $file->getClientOriginalName();
            $uploadPath = 'ImageStorage/banner/';

            // Move to public/ImageStorage/banner
            $file->move(public_path($uploadPath), $fileName);

            // Save path like: ImageStorage/banner/filename.jpg
            $imagePath = $uploadPath . $fileName;
        } else {
            $imagePath = $banner->image;
        }

        // UPDATE FIELDS
        $banner->update([
            'title'        => $request->title,
            'subtitle'     => $request->subtitle,
            'motto'        => $request->motto,
            'description'  => $request->description,
            'button_text'  => $request->button_text,
            'button_link'  => $request->button_link,
            'image'        => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Banner updated successfully!');
    }
}
