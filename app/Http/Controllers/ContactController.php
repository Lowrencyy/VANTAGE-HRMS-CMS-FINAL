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
use App\Models\Faq;
use App\Models\FaqSetting;

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

    // FAQ data for frontend
   $faqs       = Faq::orderBy('sort_order')->get();
$faqSetting = FaqSetting::first();

// kung wala pang laman yung faq_settings table, gawa tayo ng temporary default object
if (!$faqSetting) {
    $faqSetting = new FaqSetting([
        'subtitle'    => 'faq',
        'title'       => 'Most common question about our services',
        'button_text' => 'View All',
        'button_link' => null,
    ]);
}

    return view('landing.index', compact(
        'banner',
        'mission',
        'why',
        'services',
        'objectives',
        'contact',
        'faqs',
        'faqSetting'
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

    // Kunin company email sa contact_settings table
    $contactSettings = ContactSetting::first();

    // Gagamitin natin yung email_text bilang company email
    $toEmail = $contactSettings?->email_text;

    // Fallback kung wala o hindi valid
    if (! $toEmail || ! filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        $toEmail = config('mail.from.address'); // or any fallback
    }

    Mail::raw(
        "Name: {$data['name']}\n".
        "Email: {$data['email']}\n".
        "Phone: {$data['phone']}\n\n".
        "Message:\n{$data['comments']}",
        function ($message) use ($data, $toEmail) {
            $message->to($toEmail)
                    ->replyTo($data['email'], $data['name'])
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


    // faq 

    /* =======================
   CMS - FAQ PAGE
   ======================= */
public function faqCMS()
{
    $faqs = Faq::orderBy('sort_order')->get();
    $settings = FaqSetting::first();

    return view('CMS.faq', compact('faqs', 'settings'));
}

/* =======================
   CMS - SAVE FAQ SETTINGS
   ======================= */
public function faqSettingsSave(Request $request)
{
    $settings = FaqSetting::first() ?? new FaqSetting();

    $data = $request->validate([
        'subtitle'    => 'required',
        'title'       => 'required',
        'button_text' => 'required',
        'button_link' => 'nullable|url'
    ]);

    $settings->fill($data)->save();

    return back()->with('success', 'FAQ settings updated.');
}

/* =======================
   CMS - ADD / EDIT FAQ
   ======================= */
public function faqSave(Request $request)
{
    $data = $request->validate([
        'question'   => 'required|string',
        'answer'     => 'required|string',
        'sort_order' => 'nullable|numeric'
    ]);

    Faq::create($data);

    return back()->with('success', 'FAQ item added.');
}
/* =======================
   CMS - DELETE FAQ
   ======================= */
public function faqDelete($id)
{
    Faq::findOrFail($id)->delete();
    return back()->with('success', 'FAQ deleted.');
}

}
