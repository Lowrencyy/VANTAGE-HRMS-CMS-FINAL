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
            group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]"">


    <div class="page-header">
        <h1 class="text-2xl font-bold">Why Choose Us – Page Settings</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.whychoose.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- BACKGROUND IMAGE -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold mb-3 text-lg">Background Image</h2>

                @if ($why->background_image)
                    <img src="{{ asset(str_replace('public/', 'storage/', $why->background_image)) }}" 
                         class="rounded mb-3 w-full h-48 object-cover">
                @endif

                <input type="file" name="background_image" class="block mt-2 w-full">
            </div>

            <!-- BASIC INFORMATION -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold mb-3 text-lg">Page Titles</h2>

                <label class="block font-medium">Banner Title</label>
                <input type="text" 
                       name="banner_title" 
                       value="{{ $why->banner_title }}"
                       class="form-input w-full mb-3">

                <label class="block font-medium">Why Choose Us Title</label>
                <input type="text" 
                       name="title" 
                       value="{{ $why->title }}"
                       class="form-input w-full mb-3">

                <label class="block font-medium">Description</label>
                <textarea name="description" rows="5" 
                          class="form-input w-full mb-3">{{ $why->description }}</textarea>
            </div>

        </div>

        <!-- BUSINESS SOLUTIONS -->
        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="font-bold text-lg mb-4">Business Solutions (4 boxes)</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-medium">Solution Title 1</label>
                    <input type="text" 
                           name="solution_title_1" 
                           value="{{ $why->solution_title_1 }}"
                           class="form-input w-full mb-3">
                </div>

                <div>
                    <label class="block font-medium">Solution Title 2</label>
                    <input type="text" 
                           name="solution_title_2" 
                           value="{{ $why->solution_title_2 }}"
                           class="form-input w-full mb-3">
                </div>

                <div>
                    <label class="block font-medium">Solution Title 3</label>
                    <input type="text" 
                           name="solution_title_3" 
                           value="{{ $why->solution_title_3 }}"
                           class="form-input w-full mb-3">
                </div>

                <div>
                    <label class="block font-medium">Solution Title 4</label>
                    <input type="text" 
                           name="solution_title_4" 
                           value="{{ $why->solution_title_4 }}"
                           class="form-input w-full mb-3">
                </div>

            </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="flex justify-center mt-5 " style="">
              <button type="submit" class="mt-5 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update Objective</button>
        </div>

    </form>

</div>
</div>
@endsection