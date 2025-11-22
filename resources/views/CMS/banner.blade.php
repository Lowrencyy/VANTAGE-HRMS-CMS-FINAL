@extends('layouts.master')

@section('content')

<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu 
            group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu 
            group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md 
            group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md 
            group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm 
            group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm 
            pt-[calc(theme('spacing.header')_*_1)] 
            pb-[calc(theme('spacing.header')_*_0.8)] px-4 
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

    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <!-- Breadcrumb -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Hero Banner</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix 
                    ltr:before:-right-1 rtl:before:-left-1 
                    before:absolute before:text-[18px] before:-top-[3px] 
                    ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Website Content</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Hero Banner</li>
            </ul>
        </div>

        <!-- GRID: THIS FIXES ALIGNMENT -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LEFT: PREVIEW -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Current Banner Preview</h6>

                    @if($banner && $banner->image)
                        <img src="{{ asset($banner->image) }}" class="rounded-md mb-4 max-h-48 object-contain">
                    @else
                        <div class="p-6 bg-slate-100 text-center rounded-md mb-4">
                            <span class="text-slate-500">No image uploaded</span>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <h4><strong>Title:</strong> {{ $banner->title }}</h4>|
                        <h4><strong>Subtitle:</strong> {{ $banner->subtitle }}</h4>
                        <h4><strong>Motto:</strong> {{ $banner->motto }}</h4>
                        <h4><strong>Description:</strong> {{ $banner->description }}</h4>
                        <h4><strong>Button Text:</strong> {{ $banner->button_text }}</h4>
                        <h4><strong>Button Link:</strong> {{ $banner->button_link }}</h4>
                    </div>
                </div>
            </div>

            <!-- RIGHT: EDIT FORM -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Edit Banner Details</h6>

                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="font-medium">Title</label>
                            <input type="text" name="title" class="form-input" value="{{ $banner->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Subtitle</label>
                            <input type="text" name="subtitle" class="form-input" value="{{ $banner->subtitle }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Motto</label>
                            <input type="text" name="motto" class="form-input" value="{{ $banner->motto }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Description</label>
                            <textarea name="description" rows="4" class="form-input">{{ $banner->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Button Text</label>
                            <input type="text" name="button_text" class="form-input" value="{{ $banner->button_text }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Button Link</label>
                            <input type="text" name="button_link" class="form-input" value="{{ $banner->button_link }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Replace Banner Image</label>
                            <input type="file" name="image" class="form-input">
                        </div>

                        <button type="submit"
                            class="btn bg-custom-500 text-white hover:bg-custom-600">
                            Update Banner
                        </button>
                    </form>

                </div>
            </div>

        </div>
        <!-- END GRID -->
    </div>

</div>

@endsection
