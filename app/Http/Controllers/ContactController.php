<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\HeroBanner;
use App\Models\MissionVision;
use App\Models\WhyChoose;
use App\Models\Service;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /* =========================
       FRONTEND (Landing page)
       ========================= */
    public function index()
    {
        $banner     = HeroBanner::first();
        $mission    = MissionVision::first();
        $why        = WhyChoose::first();
        $services   = Service::all();
        $objectives = Objective::all();
        $contact    = ContactSetting::first();

        return view('landing.index', compact(
            'banner',
            'mission',
            'why',
            'services',
            'objectives',
            'contact'
        ));
    }

    /* =========================
       CONTACT FORM SUBMIT
       ========================= */
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'nullable|string|max:50',
            'comments' => 'required|string',
        ]);

        Mail::raw(
            "Name: {$data['name']}\nEmail: {$data['email']}\nPhone: {$data['phone']}\n\nMessage:\n{$data['comments']}",
            function ($message) {
                $message->to('info@yourdomain.com')
                        ->subject('New Contact Form Submission');
            }
        );

        return back()->with('success', 'Thank you! We will get back to you soon.');
    }

    /* =========================
       CMS VIEW (Edit Contact Us)
       ========================= */
    public function cmsEdit()
    {
        $contact = ContactSetting::first();
        return view('CMS.contactus', compact('contact'));
    }

    /* =========================
       CMS SAVE / UPDATE
       ========================= */
    public function cmsUpdate(Request $request)
    {
        $contact = ContactSetting::first() ?? new ContactSetting();

        $data = $request->validate([
            'section_subtitle'   => 'required|string',
            'section_title'      => 'required|string',
            'need_help_title'    => 'required|string',
            'need_help_subtitle' => 'required|string',
            'location_title'     => 'required|string',
            'location_text'      => 'required|string',
            'email_title'        => 'required|string',
            'email_text'         => 'required|string',
            'phone_title'        => 'required|string',
            'phone_text'         => 'required|string',
            'map_embed'          => 'required|string',
            'image_path'         => 'nullable|image|max:2048',
        ]);

      if ($request->hasFile('image_path')) {

    // File info
    $file = $request->file('image_path');

    // Make sure directory exists
    $destinationPath = public_path('ImageStorage/ContactUs');

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    // Generate filename
    $filename = time() . '_' . $file->getClientOriginalName();

    // Move file to public folder
    $file->move($destinationPath, $filename);

    // Save path to DB
    $data['image_path'] = 'ImageStorage/ContactUs/' . $filename;
}


        $contact->fill($data);
        $contact->save();

        return back()->with('success', 'Contact page updated successfully.');
    }
}
