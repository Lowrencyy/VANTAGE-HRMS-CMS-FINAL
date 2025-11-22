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
                <h5 class="text-16">Mission & Vision</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix 
                    ltr:before:-right-1 rtl:before:-left-1 
                    before:absolute before:text-[18px] before:-top-[3px] 
                    ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Website Content</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Mission & Vision</li>
            </ul>
        </div>

        <!-- GRID LAYOUT -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LEFT: PREVIEW -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Current Preview</h6>

                    {{-- Preview Image --}}
                    @if($missionVision->image)
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset($missionVision->image) }}"
                                 class="rounded-md max-h-48 object-contain mx-auto">
                        </div>
                    @else
                        <div class="p-6 bg-slate-100 text-center rounded-md mb-4">
                            <span class="text-slate-500">No image uploaded</span>
                        </div>
                    @endif

                    <div class="space-y-3 text-sm leading-tight">
                        <p><strong>Title:</strong> {{ $missionVision->title }}</p>
                        <p><strong>Description:</strong> {{ $missionVision->description }}</p>
                        <p><strong>Mission:</strong> {{ $missionVision->mission }}</p>
                        <p><strong>Vision:</strong> {{ $missionVision->vision }}</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT: EDIT FORM -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Edit Mission & Vision</h6>

                    <form action="{{ route('admin.mission.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="font-medium">Title</label>
                            <input type="text" name="title" class="form-input" value="{{ $missionVision->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Description</label>
                            <textarea name="description" rows="3" class="form-input">{{ $missionVision->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Mission</label>
                            <textarea name="mission" rows="3" class="form-input">{{ $missionVision->mission }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Vision</label>
                            <textarea name="vision" rows="3" class="form-input">{{ $missionVision->vision }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="font-medium">Replace Image</label>
                            <input type="file" name="image" class="form-input">
                        </div>

                        <button type="submit"
                            class="btn bg-custom-500 text-white hover:bg-custom-600 w-full">
                            Update Section
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
