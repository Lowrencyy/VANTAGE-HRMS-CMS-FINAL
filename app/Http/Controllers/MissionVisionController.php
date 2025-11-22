<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionVision;

class MissionVisionController extends Controller
{
    // Display page
    public function index()
    {
        // Always ensure one record exists
        $missionVision = MissionVision::first();

        if (!$missionVision) {
            $missionVision = MissionVision::create([
                'title'       => '',
                'description' => '',
                'mission'     => '',
                'vision'      => '',
                'image'       => '',
            ]);
        }

        return view('CMS.mission-vision', compact('missionVision'));
    }

    // Update only
    public function update(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'mission'     => 'nullable|string',
            'vision'      => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $missionVision = MissionVision::first();

        // Handle image upload manually (public/imagestorage/mission)
        if ($request->hasFile('image')) {

            // Delete old image if exists
            if ($missionVision->image && file_exists(public_path($missionVision->image))) {
                unlink(public_path($missionVision->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $folder = public_path('imagestorage/mission');

            // Make folder if missing
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // Move file
            $file->move($folder, $filename);

            // Path saved in DB
            $imagePath = 'imagestorage/mission/' . $filename;
        } else {
            $imagePath = $missionVision->image;
        }

        // Update fields
        $missionVision->update([
            'title'       => $request->title,
            'description' => $request->description,
            'mission'     => $request->mission,
            'vision'      => $request->vision,
            'image'       => $imagePath,
        ]);

        return back()->with('success', 'Mission & Vision updated successfully!');
    }
}
