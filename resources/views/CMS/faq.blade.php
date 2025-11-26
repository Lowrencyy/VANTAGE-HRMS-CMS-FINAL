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

        {{-- PAGE HEADER --}}
        <div class="page-header mb-4">
            <h1 class="text-2xl font-bold">FAQ – Page Settings</h1>
            <p class="text-slate-500 text-sm mt-1">
                Manage the FAQ section content displayed on your landing page.
            </p>
        </div>

        {{-- FLASH MESSAGES --}}
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

        {{-- FAQ HEADER SETTINGS --}}
        <form action="{{ route('admin.faq.settings') }}" method="POST" class="mb-6">
            @csrf

            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold mb-3 text-lg">FAQ Header</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm mb-1">Subtitle</label>
                        <input type="text"
                               name="subtitle"
                               value="{{ old('subtitle', $settings->subtitle ?? 'faq') }}"
                               class="form-input w-full mb-3"
                               placeholder="e.g. faq">

                        <label class="block font-medium text-sm mb-1">Main Title</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $settings->title ?? 'Most common question about our services') }}"
                               class="form-input w-full mb-3"
                               placeholder="e.g. Most common question about our services">
                    </div>

                    <div>
                       
                      

                        <label class="block font-medium text-sm mb-1">Button Link (optional)</label>
                        <input type="text"
                               name="button_link"
                               value="{{ old('button_link', $settings->button_link ?? '') }}"
                               class="form-input w-full mb-3"
                               placeholder="https://yourdomain.com/faqs">
                        <p class="text-xs text-slate-400">
                            Leave empty if you don't want the button to link anywhere.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-3">
                    <button type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 
                                   hover:text-white hover:bg-custom-600 hover:border-custom-600 
                                   focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 
                                   active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 
                                   dark:ring-custom-400/20">
                        Save Header
                    </button>
                </div>
            </div>
        </form>

        {{-- FAQ ITEMS (ADD + LIST) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- LEFT: ADD FAQ --}}
            <form action="{{ route('admin.faq.add') }}" method="POST">
                @csrf
                <div class="bg-white p-6 rounded shadow h-full">
                    <h2 class="font-bold mb-3 text-lg">Add FAQ Item</h2>

                    <label class="block font-medium text-sm mb-1">Question</label>
                    <input type="text"
                           name="question"
                           value="{{ old('question') }}"
                           class="form-input w-full mb-3"
                           placeholder="Enter question">

                    <label class="block font-medium text-sm mb-1">Answer</label>
                    <textarea name="answer"
                              rows="5"
                              class="form-input w-full mb-3"
                              placeholder="Enter answer">{{ old('answer') }}</textarea>

                    <label class="block font-medium text-sm mb-1">Sort Order</label>
                    <input type="number"
                           name="sort_order"
                           value="{{ old('sort_order', 0) }}"
                           class="form-input w-full mb-3"
                           placeholder="0 = top">

                    <div class="flex justify-center mt-2">
                        <button type="submit"
                                class="text-white btn bg-custom-500 border-custom-500 
                                   hover:text-white hover:bg-custom-600 hover:border-custom-600 
                                   focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 
                                   active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 
                                   dark:ring-custom-400/20" >
                            Add FAQ
                        </button>
                    </div>
                </div>
            </form>

            {{-- RIGHT: LIST FAQ --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold mb-3 text-lg">Existing FAQs</h2>

                @if($faqs->isEmpty())
                    <p class="text-sm text-slate-500">No FAQ items yet. Add your first FAQ on the left.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-2 pr-2">Question</th>
                                    <th class="text-left py-2 px-2 w-20">Order</th>
                                    <th class="text-left py-2 px-2 w-24">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faqs as $faq)
                                    <tr class="border-b">
                                        <td class="py-2 pr-2 align-top">
                                            {{ $faq->question }}
                                        </td>
                                        <td class="py-2 px-2 align-top">
                                            {{ $faq->sort_order }}
                                        </td>
                                        <td class="py-2 px-2 align-top">
                                            <form action="{{ route('admin.faq.delete', $faq->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this FAQ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-xs text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

@endsection
