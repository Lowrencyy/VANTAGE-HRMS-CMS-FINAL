@extends('layouts.master')

@section('content')

<div class="content">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu 
                group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu 
                group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md 
                group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md 
                group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm 
                group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm 
                pt-[calc(theme('spacing.header')_*_1)] 
                pb-[calc(theme('spacing.header')_*_0.8)] 
                px-4 
                group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] 
                group-data-[navbar=hidden]:pt-0 
                group-data-[layout=horizontal]:mx-auto 
                group-data-[layout=horizontal]:max-w-screen-2xl 
                group-data-[layout=horizontal]:px-0 
                group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto 
                group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto 
                group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] 
                group-data-[layout=horizontal]:px-3 
                group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="page-header mb-4">
            <h1 class="text-2xl font-bold">Contact Us – Page Settings</h1>
            <p class="text-slate-500 text-sm mt-1">
                Manage the content of your Contact Us section on the website.
            </p>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contactus.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- TOP GRID: HERO / HEADINGS + RIGHT IMAGE --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- LEFT: SECTION TITLES + LEFT CONTENT --}}
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="font-bold mb-3 text-lg">Section Headings</h2>

                    <label class="block font-medium text-sm mb-1">Section Subtitle</label>
                    <input type="text"
                           name="section_subtitle"
                           value="{{ old('section_subtitle', $contact->section_subtitle) }}"
                           class="form-input w-full mb-3"
                           placeholder="e.g. Contact Us">

                    <label class="block font-medium text-sm mb-1">Section Title</label>
                    <input type="text"
                           name="section_title"
                           value="{{ old('section_title', $contact->section_title) }}"
                           class="form-input w-full mb-3"
                           placeholder="e.g. What we do?">

                    <hr class="my-4">

                    <h3 class="font-semibold mb-3 text-base">Left Block (Need Help)</h3>

                    <label class="block font-medium text-sm mb-1">Heading</label>
                    <input type="text"
                           name="need_help_title"
                           value="{{ old('need_help_title', $contact->need_help_title) }}"
                           class="form-input w-full mb-3"
                           placeholder="e.g. Need Help?">

                    <label class="block font-medium text-sm mb-1">Subtext</label>
                    <textarea name="need_help_subtitle"
                              rows="3"
                              class="form-input w-full mb-3"
                              placeholder="Short description shown under the heading.">{{ old('need_help_subtitle', $contact->need_help_subtitle) }}</textarea>
                </div>

                {{-- RIGHT: IMAGE PREVIEW & UPLOAD --}}
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="font-bold mb-3 text-lg">Right Side Image</h2>

                    @if ($contact->image_path)
                        <div class="mb-3">
                            <p class="text-xs text-slate-500 mb-1">Current Image Preview</p>
                            <img src="{{ asset($contact->image_path) }}"
                                 class="rounded w-full h-48 object-cover border">
                        </div>
                    @endif

                    <label class="block font-medium text-sm mb-1">Upload New Image</label>
                    <input type="file" name="image_path" class="block mt-1 w-full text-sm">

                    <p class="text-xs text-slate-400 mt-2">
                        Recommended size: 800x600 or similar. JPG/PNG only.
                    </p>
                </div>

            </div>

            {{-- CONTACT DETAILS BOXES --}}
            <div class="bg-white p-6 rounded shadow mt-6">
                <h2 class="font-bold text-lg mb-4">Contact Details (Below the Form)</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- LOCATION --}}
                    <div>
                        <h3 class="font-semibold text-sm mb-2">Location Box</h3>

                        <label class="block font-medium text-xs mb-1">Location Title</label>
                        <input type="text"
                               name="location_title"
                               value="{{ old('location_title', $contact->location_title) }}"
                               class="form-input w-full mb-2"
                               placeholder="e.g. Our Location">

                        <label class="block font-medium text-xs mb-1">Location Text</label>
                        <textarea name="location_text"
                                  rows="3"
                                  class="form-input w-full"
                                  placeholder="e.g. Database Text Address">{{ old('location_text', $contact->location_text) }}</textarea>
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <h3 class="font-semibold text-sm mb-2">Email Box</h3>

                        <label class="block font-medium text-xs mb-1">Email Title</label>
                        <input type="text"
                               name="email_title"
                               value="{{ old('email_title', $contact->email_title) }}"
                               class="form-input w-full mb-2"
                               placeholder="e.g. Email Us">

                        <label class="block font-medium text-xs mb-1">Email Text</label>
                        <textarea name="email_text"
                                  rows="3"
                                  class="form-input w-full"
                                  placeholder="e.g. info@yourdomain.com">{{ old('email_text', $contact->email_text) }}</textarea>
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <h3 class="font-semibold text-sm mb-2">Phone Box</h3>

                        <label class="block font-medium text-xs mb-1">Phone Title</label>
                        <input type="text"
                               name="phone_title"
                               value="{{ old('phone_title', $contact->phone_title) }}"
                               class="form-input w-full mb-2"
                               placeholder="e.g. Call Us">

                        <label class="block font-medium text-xs mb-1">Phone Text</label>
                        <textarea name="phone_text"
                                  rows="3"
                                  class="form-input w-full"
                                  placeholder="e.g. +456 456 4443">{{ old('phone_text', $contact->phone_text) }}</textarea>
                    </div>

                </div>
            </div>

            {{-- MAP SETTINGS --}}
            <div class="bg-white p-6 rounded shadow mt-6">
                <h2 class="font-bold text-lg mb-4">Google Map</h2>

                <label class="block font-medium text-sm mb-1">Map Embed URL / Iframe src</label>
                <textarea name="map_embed"
                          rows="3"
                          class="form-input w-full mb-3"
                          placeholder="Paste your Google Maps embed src here">{{ old('map_embed', $contact->map_embed) }}</textarea>

                <p class="text-xs text-slate-400">
                    You can paste the full embed URL from Google Maps. The front-end will use this value inside the
                    <code>&lt;iframe src=""&gt;</code>.
                </p>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="flex justify-center mt-4">
                <button type="submit"
                        class="text-white btn bg-custom-500 border-custom-500 
                               hover:text-white hover:bg-custom-600 hover:border-custom-600 
                               focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 
                               active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 
                               dark:ring-custom-400/20">
                    Update Contact Us Page
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
