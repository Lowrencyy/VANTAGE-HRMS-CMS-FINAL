{{-- resources/views/admin/services/create.blade.php --}}
@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            {{-- Page Header / Breadcrumb --}}
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Add New Service</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="{{ route('services.index') }}" class="text-slate-400 dark:text-zink-200">Services</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">Add Service</li>
                </ul>
            </div>

            {{-- Card --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center mb-4">
                        <h6 class="text-15 grow">Service Details</h6>
                        <div class="shrink-0">
                            <a href="{{ route('services.index') }}"
                               class="text-slate-500 bg-slate-100 hover:text-slate-700 hover:bg-slate-200 dark:bg-zink-600 dark:text-zink-200 dark:hover:text-white dark:hover:bg-zink-500 px-3 py-1 rounded-md text-sm">
                                Back to List
                            </a>
                        </div>
                    </div>

                    {{-- Create Form --}}
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                            {{-- Title --}}
                            <div class="xl:col-span-12">
                                <label for="title" class="inline-block mb-2 text-base font-medium">Service Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-input border-slate-200 dark:border-zink-500"
                                    placeholder="Enter service title"
                                    value="{{ old('title') }}"
                                    required
                                >
                                @error('title')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="xl:col-span-12">
                                <label for="description" class="inline-block mb-2 text-base font-medium">Service Description</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="form-input border-slate-200 dark:border-zink-500"
                                    placeholder="Enter service description"
                                    required
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Check List --}}
                            <div class="xl:col-span-12">
                                <label for="check_list" class="inline-block mb-2 text-base font-medium">
                                    Checklist (comma-separated)
                                </label>
                                <textarea
                                    name="check_list"
                                    id="check_list"
                                    rows="3"
                                    class="form-input border-slate-200 dark:border-zink-500"
                                    placeholder="Example: Free HR Consultation, Payroll Management, Employee Onboarding"
                                    required
                                >{{ old('check_list') }}</textarea>
                                @error('check_list')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="xl:col-span-12">
                                <label for="image" class="inline-block mb-2 text-base font-medium">Service Image</label>
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="form-input border-slate-200 dark:border-zink-500"
                                >
                                <p class="mt-1 text-xs text-slate-500">
                                    Optional. Allowed types: jpeg, png, jpg, gif, svg. Max 2MB.
                                </p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('services.index') }}"
                               class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Save Service
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
@endsection
