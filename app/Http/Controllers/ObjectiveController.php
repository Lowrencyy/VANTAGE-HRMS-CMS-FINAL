<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    /**
     * Display the list of objectives
     */
    public function index()
    {
        $objectives = Objective::all();
        return view('CMS.objective', compact('objectives'));
    }

    /**
     * Store a new objective in the database
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/objectives'), $imageName);
                $imagePath = 'images/objectives/' . $imageName;
            }

            // Create and save the new objective
            Objective::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath ?? null,
            ]);

            flash()->success('Objective added successfully!');
            return redirect()->route('admin.objectives');
        } catch (\Exception $e) {
            \Log::error('Error creating objective: ' . $e->getMessage());
            flash()->error('Failed to add objective. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Update an existing objective in the database
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Find the objective by ID
            $objective = Objective::findOrFail($id);

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($objective->image && file_exists(public_path($objective->image))) {
                    unlink(public_path($objective->image));
                }

                // Upload new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/objectives'), $imageName);
                $imagePath = 'images/objectives/' . $imageName;
                
                // Update image path
                $objective->image = $imagePath;
            }

            // Update the objective fields
            $objective->title = $request->title;
            $objective->description = $request->description;
            $objective->save();

            flash()->success('Objective updated successfully!');
            return redirect()->route('admin.objectives');
        } catch (\Exception $e) {
            \Log::error('Error updating objective: ' . $e->getMessage());
            flash()->error('Failed to update objective. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Delete an existing objective
     */
    public function destroy($id)
    {
        try {
            $objective = Objective::findOrFail($id);

            // Delete the image file if it exists
            if ($objective->image && file_exists(public_path($objective->image))) {
                unlink(public_path($objective->image));
            }

            // Delete the objective record
            $objective->delete();

            flash()->success('Objective deleted successfully!');
            return redirect()->route('admin.objectives');
        } catch (\Exception $e) {
            \Log::error('Error deleting objective: ' . $e->getMessage());
            flash()->error('Failed to delete objective. Please try again.');
            return redirect()->back();
        }
    }
}