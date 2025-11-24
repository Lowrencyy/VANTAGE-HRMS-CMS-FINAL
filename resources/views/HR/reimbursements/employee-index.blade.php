@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu 
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
            group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]"
    >
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            @php
                $pendingCount  = $reimbursements->where('status', 'pending')->count();
                $approvedCount = $reimbursements->where('status', 'approved')->count();
                $deniedCount   = $reimbursements->where('status', 'denied')->count();
            @endphp

            {{-- PAGE HEADER --}}
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">My Reimbursements</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Reimbursements</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        My Reimbursements
                    </li>
                </ul>
            </div>

            {{-- FLASH MESSAGES --}}
            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-200 rounded-md px-3 py-2 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-red-700 bg-red-100 border border-red-200 rounded-md px-3 py-2 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())
                <div class="mb-4 text-red-700 bg-red-100 border border-red-200 rounded-md px-3 py-2 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-12 mb-5">

                {{-- Total Requests --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-sky-500 bg-sky-100 rounded-md size-12 text-15 dark:bg-sky-500/20 shrink-0">
                                <i data-lucide="file-text"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">{{ $reimbursements->count() }}</h5>
                                <p class="text-slate-500 dark:text-zink-200">Total Requests</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-yellow-500 bg-yellow-100 rounded-md size-12 text-15 dark:bg-yellow-500/20 shrink-0">
                                <i data-lucide="clock-3"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">{{ $pendingCount }}</h5>
                                <p class="text-slate-500 dark:text-zink-200">Pending</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Approved --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-sky-500 bg-sky-100 rounded-md size-12 text-15 dark:bg-sky-500/20 shrink-0">
                                <i data-lucide="check-circle-2"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">{{ $approvedCount }}</h5>
                                <p class="text-slate-500 dark:text-zink-200">Approved</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Declined --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-red-500 bg-red-100 rounded-md size-12 text-15 dark:bg-red-500/20 shrink-0">
                                <i data-lucide="x-circle"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">{{ $deniedCount }}</h5>
                                <p class="text-slate-500 dark:text-zink-200">Declined</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- MAIN CARD --}}
            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-4 mb-5 lg:grid-cols-2 xl:grid-cols-12">
                        <h6 class="text-15 grow">Reimbursements</h6>
                        <div class="xl:col-span-2 xl:col-start-11">
                            <div class="ltr:lg:text-right rtl:lg:text-left">
                                {{-- OPEN MODAL BUTTON --}}
                                <button
                                    data-modal-target="newReimbursementModal"
                                    type="button"
                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    <i data-lucide="plus" class="inline-block size-4"></i>
                                    <span class="align-middle">New Reimbursement</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- DATA TABLE --}}
                    <table id="alternativePagination" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>My Receipt</th>
                                <th>HR Receipt</th>
                                <th>Submitted At</th>
                                <th class="ltr:text-right rtl:text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reimbursements as $index => $item)

                                @php
                                    $empPath = $item->employee_receipt_path;
                                    $hrPath  = $item->hr_receipt_path;

                                    // UPDATED: Direct asset() call, no 'storage/' prefix
                                    $empUrl = $empPath ? asset($empPath) : null;
                                    $hrUrl  = $hrPath  ? asset($hrPath)  : null;

                                    $empExt = $empPath ? strtolower(pathinfo($empPath, PATHINFO_EXTENSION)) : null;
                                    $hrExt  = $hrPath  ? strtolower(pathinfo($hrPath, PATHINFO_EXTENSION))  : null;
                                @endphp

                                <tr>
                                    {{-- 1: No --}}
                                    <td>{{ $index + 1 }}</td>

                                    {{-- 2: Title --}}
                                    <td>{{ $item->title ?? 'No title' }}</td>

                                    {{-- 3: Amount --}}
                                    <td>{{ number_format($item->amount, 2) }}</td>

                                    {{-- 4: Status --}}
                                    <td>
                                        @if($item->status === 'pending')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                                Pending
                                            </span>
                                        @elseif($item->status === 'approved')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-sky-100 border-transparent text-sky-500 dark:bg-sky-500/20 dark:border-transparent">
                                                Approved (Waiting Payment)
                                            </span>
                                        @elseif($item->status === 'paid')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                                Paid
                                            </span>
                                        @elseif($item->status === 'denied')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                                Denied
                                            </span>
                                        @else
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-600 dark:bg-zink-500/20 dark:border-transparent">
                                                {{ ucfirst($item->status ?? 'Unknown') }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- 5: Employee Receipt (MODAL) --}}
                                    <td>
                                        @if($empPath && $empUrl)
                                            <button type="button"
                                                data-modal-target="employeeReceiptModal-{{ $item->id }}"
                                                class="text-custom-500 hover:text-custom-600 underline text-sm">
                                                View
                                            </button>

                                            {{-- EMPLOYEE RECEIPT MODAL --}}
                                            <div
                                                id="employeeReceiptModal-{{ $item->id }}"
                                                modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show"
                                            >
                                                <div class="w-screen md:w-[32rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                                        <h5 class="text-16">My Receipt</h5>
                                                        <button
                                                            data-modal-close="employeeReceiptModal-{{ $item->id }}"
                                                            class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                            <i data-lucide="x" class="w-5 h-5"></i>
                                                        </button>
                                                    </div>
                                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                                        @if(in_array($empExt, ['jpg','jpeg','png','gif','webp']))
                                                            <img src="{{ $empUrl }}"
                                                                 alt="Employee Receipt"
                                                                 class="w-full h-auto rounded-md border border-slate-200">
                                                        @elseif($empExt === 'pdf')
                                                            <iframe src="{{ $empUrl }}"
                                                                    class="w-full h-[60vh] rounded-md border border-slate-200"
                                                                    frameborder="0"></iframe>
                                                        @else
                                                            <p class="text-sm text-slate-600 dark:text-zink-200">
                                                                Unsupported file type.  
                                                                <a href="{{ $empUrl }}"
                                                                   target="_blank"
                                                                   class="text-custom-500 hover:underline">
                                                                    Download file
                                                                </a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                 
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">Not uploaded</span>
                                        @endif
                                    </td>

                                    {{-- 6: HR Receipt (MODAL) --}}
                                    <td>
                                        @if($hrPath && $hrUrl)
                                            <button type="button"
                                                data-modal-target="hrReceiptModal-{{ $item->id }}"
                                                class="text-custom-500 hover:text-custom-600 underline text-sm">
                                                View
                                            </button>

                                            {{-- HR RECEIPT MODAL --}}
                                            <div
                                                id="hrReceiptModal-{{ $item->id }}"
                                                modal-center=""
                                                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show"
                                            >
                                                <div class="w-screen md:w-[32rem] bg-white shadow rounded-md dark:bg-zink-600">
                                                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                                        <h5 class="text-16">HR Receipt</h5>
                                                        <button
                                                            data-modal-close="hrReceiptModal-{{ $item->id }}"
                                                            class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                            <i data-lucide="x" class="w-5 h-5"></i>
                                                        </button>
                                                    </div>
                                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                                        @if(in_array($hrExt, ['jpg','jpeg','png','gif','webp']))
                                                            <img src="{{ $hrUrl }}"
                                                                 alt="HR Receipt"
                                                                 class="w-full h-auto rounded-md border border-slate-200">
                                                        @elseif($hrExt === 'pdf')
                                                            <iframe src="{{ $hrUrl }}"
                                                                    class="w-full h-[60vh] rounded-md border border-slate-200"
                                                                    frameborder="0"></iframe>
                                                        @else
                                                            <p class="text-sm text-slate-600 dark:text-zink-200">
                                                                Unsupported file type.  
                                                                <a href="{{ $hrUrl }}"
                                                                   target="_blank"
                                                                   class="text-custom-500 hover:underline">
                                                                    Download file
                                                                </a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">Not available</span>
                                        @endif
                                    </td>

                                    {{-- 7: Submitted At --}}
                                    <td>
                                        {{ $item->created_at?->format('Y-m-d H:i') }}
                                    </td>

                                    {{-- 8: Action --}}
                                    <td class="ltr:text-right rtl:text-left">
                                        <div class="flex justify-end gap-2">
                                            {{-- Details modal button --}}
                                            <button type="button"
                                                    data-modal-target="reimbursementDetailModal-{{ $item->id }}"
                                                    class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 text-custom-500 bg-custom-100 hover:text-white hover:bg-custom-500 dark:bg-custom-500/20 dark:hover:bg-custom-500">
                                                <i data-lucide="info" class="size-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- DETAILS MODAL --}}
                                <div
                                    id="reimbursementDetailModal-{{ $item->id }}"
                                    modal-center=""
                                    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show"
                                >
                                    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                        <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                            <h5 class="text-16">Reimbursement Details</h5>
                                            <button
                                                data-modal-close="reimbursementDetailModal-{{ $item->id }}"
                                                class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                <i data-lucide="x" class="w-5 h-5"></i>
                                            </button>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto text-sm space-y-2">
                                            <p><strong>Title:</strong> {{ $item->title ?? 'No title' }}</p>
                                            <p><strong>Amount:</strong> {{ number_format($item->amount, 2) }}</p>
                                            <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
                                            <p><strong>Description:</strong><br>
                                                {{ $item->description ?? 'No description provided.' }}
                                            </p>
                                            <p><strong>Submitted At:</strong> {{ $item->created_at }}</p>

                                            <p><strong>My Receipt:</strong>
                                                @if($empPath && $empUrl)
                                                    <button type="button"
                                                        data-modal-target="employeeReceiptModal-{{ $item->id }}"
                                                        class="text-custom-500 hover:text-custom-600 underline text-sm">
                                                        View
                                                    </button>
                                                @else
                                                    <span class="text-xs text-slate-400">Not uploaded</span>
                                                @endif
                                            </p>

                                            <p><strong>HR Receipt:</strong>
                                                @if($hrPath && $hrUrl)
                                                    <button type="button"
                                                        data-modal-target="hrReceiptModal-{{ $item->id }}"
                                                        class="text-custom-500 hover:text-custom-600 underline text-sm">
                                                        View
                                                    </button>
                                                @else
                                                    <span class="text-xs text-slate-400">Not available</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="flex justify-end gap-2 px-4 py-3 border-t dark:border-zink-500">
                                            <button
                                                type="button"
                                                data-modal-close="reimbursementDetailModal-{{ $item->id }}"
                                                class="bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-600 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="8" class="px-3.5 py-4 text-center text-slate-500">
                                        No reimbursement requests found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->

    {{-- NEW REIMBURSEMENT MODAL --}}
    <div
        id="newReimbursementModal"
        modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show"
    >
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16">New Reimbursement</h5>
                <button
                    data-modal-close="newReimbursementModal"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form action="{{ route('employee.reimbursements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                        <div class="xl:col-span-12">
                            <label class="inline-block mb-2 text-base font-medium">Title (optional)</label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="e.g. Taxi to client meeting"
                            >
                        </div>

                        <div class="xl:col-span-12">
                            <label class="inline-block mb-2 text-base font-medium">
                                Amount <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                step="0.01"
                                name="amount"
                                value="{{ old('amount') }}"
                                required
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="0.00"
                            >
                        </div>

                        <div class="xl:col-span-12">
                            <label class="inline-block mb-2 text-base font-medium">Description (optional)</label>
                            <textarea
                                name="description"
                                rows="3"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Short explanation">{{ old('description') }}</textarea>
                        </div>

                        <div class="xl:col-span-12">
                            <label class="inline-block mb-2 text-base font-medium">Receipt (image or PDF)</label>
                            <input
                                type="file"
                                name="employee_receipt"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            >
                            <p class="mt-1 text-xs text-slate-400">
                                Allowed: jpg, jpeg, png, pdf (max 4MB)
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button
                            type="reset"
                            data-modal-close="newReimbursementModal"
                            class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof $.fn.DataTable !== 'undefined') {
                if (!$.fn.DataTable.isDataTable('#alternativePagination')) {
                    $('#alternativePagination').DataTable();
                }
            }

            // Auto-open the New Reimbursement modal if validation failed
            @if ($errors->any())
                const modal = document.getElementById('newReimbursementModal');
                if (modal) {
                    modal.classList.remove('hidden');
                }
            @endif
        });
    </script>
@endsection
