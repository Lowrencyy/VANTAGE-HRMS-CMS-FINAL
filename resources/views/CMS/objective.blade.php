@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Objective List</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Website Content</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">Objectives</li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Objectives List</h6>
                        <div class="shrink-0">
                            <button data-modal-target="addObjectiveModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus inline-block size-4">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg> 
                                <span class="align-middle">Add Objective</span>
                            </button>
                        </div>
                    </div>
                    <br>
                    <table id="alternativePagination" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($objectives as $key => $objective)
                                <tr class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $objective->title }}</td>
                                    <td>{{ Str::limit($objective->description, 50) }}</td>
                                    <td>
                                        @if($objective->image)
                                            <img src="{{ asset($objective->image) }}" alt="Objective Image" width="50">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5">
                                        <div class="flex gap-3">
                                            <button data-modal-target="editObjectiveModal{{ $objective->id }}" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 text-slate-500 bg-slate-100 hover:text-white hover:bg-slate-500 dark:bg-zink-600 dark:text-zink-200 dark:hover:text-white dark:hover:bg-zink-500">
                                                <i data-lucide="pencil" class="size-4"></i>
                                            </button>

                                            <form action="{{ route('admin.objectives.destroy', $objective->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:text-red-500 dark:hover:bg-red-500/20" onclick="return confirm('Are you sure you want to delete this objective?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="trash-2" class="lucide lucide-trash-2 size-4">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Objective Modal for each objective -->
                                <div id="editObjectiveModal{{ $objective->id }}" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                        <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                            <h5 class="text-16">Edit Objective</h5>
                                            <button data-modal-close="editObjectiveModal{{ $objective->id }}" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                <i data-lucide="x" class="w-5 h-5"></i>
                                            </button>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                            <form action="{{ route('admin.objectives.update', $objective->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                                    <div class="xl:col-span-12">
                                                        <label for="edit_title{{ $objective->id }}" class="inline-block mb-2 text-base font-medium">Objective Title</label>
                                                        <input type="text" name="title" id="edit_title{{ $objective->id }}" class="form-input border-slate-200 dark:border-zink-500" placeholder="Objective title" value="{{ old('title', $objective->title) }}" required>
                                                        @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="xl:col-span-12">
                                                        <label for="edit_description{{ $objective->id }}" class="inline-block mb-2 text-base font-medium">Objective Description</label>
                                                        <textarea name="description" id="edit_description{{ $objective->id }}" class="form-input border-slate-200 dark:border-zink-500" placeholder="Objective description" required>{{ old('description', $objective->description) }}</textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="xl:col-span-12">
                                                        <label for="edit_image{{ $objective->id }}" class="inline-block mb-2 text-base font-medium">Objective Image</label>
                                                        @if($objective->image)
                                                            <div class="mb-2">
                                                                <img src="{{ asset($objective->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded">
                                                                <p class="text-sm text-slate-500 mt-1">Current image (leave empty to keep)</p>
                                                            </div>
                                                        @endif
                                                        <input type="file" name="image" id="edit_image{{ $objective->id }}" class="form-input border-slate-200 dark:border-zink-500">
                                                        @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="flex justify-end gap-2 mt-4">
                                                    <button type="button" data-modal-close="editObjectiveModal{{ $objective->id }}" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                                                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update Objective</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Objective Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->

    <!-- Add Objective Modal -->
    <div id="addObjectiveModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16">Add Objective</h5>
                <button data-modal-close="addObjectiveModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form class="create-form" action="{{ route('admin.objectives.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <label for="title" class="inline-block mb-2 text-base font-medium">Objective Title</label>
                            <input type="text" name="title" id="title" class="form-input border-slate-200 dark:border-zink-500" placeholder="Objective title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="xl:col-span-12">
                            <label for="description" class="inline-block mb-2 text-base font-medium">Objective Description</label>
                            <textarea name="description" id="description" class="form-input border-slate-200 dark:border-zink-500" placeholder="Objective description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="xl:col-span-12">
                            <label for="image" class="inline-block mb-2 text-base font-medium">Objective Image</label>
                            <input type="file" name="image" id="image" class="form-input border-slate-200 dark:border-zink-500" required>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="reset" id="close-modal" data-modal-close="addObjectiveModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Cancel</button>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Add Objective</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Objective Modal -->

@endsection