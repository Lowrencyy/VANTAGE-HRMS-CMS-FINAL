<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display the list of services (CMS dashboard)
     */
    public function index()
    {
        $services = Service::all();
        // Ito yung dashboard mo: resources/views/CMS/services.blade.php
        return view('CMS.services', compact('services'));
    }

    /**
     * Show the form for creating a new service
     * (hiwalay page, hindi dashboard)
     */
    public function create()
    {
        // Ito yung gagawin nating bagong view: resources/views/admin/services/create.blade.php
        return view('admin.services.create');
    }

    /**
     * Store a new service in the database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'check_list'  => 'required', // textarea, comma separated
        ]);

        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image      = $request->file('image');
                $imageName  = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/services'), $imageName);
                $imagePath = 'images/services/' . $imageName;
            }

            // Convert comma-separated checklist to string
            $rawChecklist = is_array($request->check_list)
                ? $request->check_list[0]                 // dahil name="check_list[]"
                : $request->check_list;

            $cleanChecklist = collect(explode(',', $rawChecklist))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->implode(',');

            Service::create([
                'title'      => $request->title,
                'description'=> $request->description,
                'image'      => $imagePath,
                'check_list' => $cleanChecklist,
            ]);

            if (function_exists('flash')) {
                flash()->success('Service added successfully!');
            }

            return redirect()->route('services.index');
        } catch (\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());

            if (function_exists('flash')) {
                flash()->error('Failed to add service. Please try again.');
            }

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing a service
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update an existing service
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'check_list'  => 'required',
        ]);

        try {
            $service = Service::findOrFail($id);

            // Handle image upload if new one is provided
            if ($request->hasFile('image')) {
                if ($service->image && file_exists(public_path($service->image))) {
                    @unlink(public_path($service->image));
                }

                $image      = $request->file('image');
                $imageName  = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/services'), $imageName);
                $service->image = 'images/services/' . $imageName;
            }

            $rawChecklist = is_array($request->check_list)
                ? $request->check_list[0]
                : $request->check_list;

            $cleanChecklist = collect(explode(',', $rawChecklist))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->implode(',');

            $service->title       = $request->title;
            $service->description = $request->description;
            $service->check_list  = $cleanChecklist;
            $service->save();

            if (function_exists('flash')) {
                flash()->success('Service updated successfully!');
            }

            return redirect()->route('services.index');
        } catch (\Exception $e) {
            \Log::error('Error updating service: ' . $e->getMessage());

            if (function_exists('flash')) {
                flash()->error('Failed to update service. Please try again.');
            }

            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete an existing service
     */
    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);

            if ($service->image && file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }

            $service->delete();

            if (function_exists('flash')) {
                flash()->success('Service deleted successfully!');
            }

            return redirect()->route('services.index');
        } catch (\Exception $e) {
            \Log::error('Error deleting service: ' . $e->getMessage());

            if (function_exists('flash')) {
                flash()->error('Failed to delete service. Please try again.');
            }

            return redirect()->back();
        }
    }
}



// @php
//     $items = $service->check_list
//         ? explode(',', $service->check_list)
//         : [];
// @endphp

// <ul class="service-checklist">
//     @foreach($items as $item)
//         <li>
//             <i class="ri-check-line"></i> {{-- or fontawesome / icon mo --}}
//             {{ trim($item) }}
//         </li>
//     @endforeach
// </ul>

