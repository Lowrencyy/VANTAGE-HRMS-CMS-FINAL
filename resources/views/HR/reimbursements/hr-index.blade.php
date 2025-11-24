@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            {{-- Page Header / Breadcrumb --}}
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Reimbursements (HR)</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">HR Management</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Reimbursements
                    </li>
                </ul>
            </div>

            {{-- Flash messages --}}
            @if(session('success'))
                <div
                    class="mb-4 px-4 py-3 text-sm text-green-700 bg-green-100 border border-green-200 rounded-md dark:bg-green-500/10 dark:text-green-200 dark:border-green-500/40">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-4 px-4 py-3 text-sm text-red-700 bg-red-100 border border-red-200 rounded-md dark:bg-red-500/10 dark:text-red-200 dark:border-red-500/40">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Top Stats Cards --}}
            <div class="grid grid-cols-1 gap-x-5 gap-y-4 md:grid-cols-2 xl:grid-cols-12 mb-4">
                {{-- Total Requests --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-custom-500 bg-custom-100 rounded-md size-12 text-15 dark:bg-custom-500/20 shrink-0">
                                <i data-lucide="file-text"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value"
                                          data-target="{{ $totalRequest ?? 0 }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Total Requests</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Today Requests --}}
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-sky-500 bg-sky-100 rounded-md size-12 text-15 dark:bg-sky-500/20 shrink-0">
                                <i data-lucide="calendar-clock"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value"
                                          data-target="{{ $todayRequest ?? 0 }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Today Requests</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Approved --}}
                <div class="xl:col-span-2">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-blue-500 bg-blue-100 rounded-md size-12 text-15 dark:bg-blue-500/20 shrink-0">
                                <i data-lucide="check-circle-2"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value"
                                          data-target="{{ $approvedCount ?? 0 }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Approved</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Unpaid --}}
                <div class="xl:col-span-2">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-amber-500 bg-amber-100 rounded-md size-12 text-15 dark:bg-amber-500/20 shrink-0">
                                <i data-lucide="wallet-cards"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value"
                                          data-target="{{ $unpaidCount ?? 0 }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Unpaid</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="xl:col-span-2">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-yellow-500 bg-yellow-100 rounded-md size-12 text-15 dark:bg-yellow-500/20 shrink-0">
                                <i data-lucide="clock-4"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value"
                                          data-target="{{ $pendingCount ?? 0 }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Pending Requests</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reimbursements Table --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center mb-4">
                        <h6 class="text-15 grow">Reimbursements</h6>
                    </div>

                    <table id="alternativePagination" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Employee Receipt</th>
                            <th>HR Receipt</th>
                            <th class="ltr:!text-right rtl:!text-left">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($all as $reimbursement)
                            @php
                                $status = $reimbursement->status;

                                // Paths saved in DB (example):
                                // employee_receipt_path = 'imagestorage/employeeReciept/filename.ext'
                                // hr_receipt_path       = 'imagestorage/HRReciept/filename.ext'

                                $empPath = $reimbursement->employee_receipt_path;
                                $hrPath  = $reimbursement->hr_receipt_path;

                                $employeeReceiptUrl = $empPath ? asset($empPath) : null;
                                $hrReceiptUrl       = $hrPath  ? asset($hrPath)  : null;

                                $empExt = $empPath ? strtolower(pathinfo($empPath, PATHINFO_EXTENSION)) : null;
                                $hrExt  = $hrPath  ? strtolower(pathinfo($hrPath, PATHINFO_EXTENSION))  : null;
                            @endphp

                            <tr class="border-y border-slate-200 dark:border-zink-500">
                                {{-- No --}}
                                <td class="px-3.5 py-2.5">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Employee --}}
                                <td class="px-3.5 py-2.5">
                                    <div class="flex flex-col">
                                        <span class="font-medium">
                                            {{ $reimbursement->employee->name ?? 'Unknown Employee' }}
                                        </span>
                                        <span class="text-xs text-slate-500">
                                            ID: {{ $reimbursement->employee->user_id ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Title --}}
                                <td class="px-3.5 py-2.5">
                                    {{ $reimbursement->title ?? '-' }}
                                </td>

                                {{-- Amount --}}
                                <td class="px-3.5 py-2.5">
                                    ₱ {{ number_format($reimbursement->amount, 2) }}
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-3.5 py-2.5">
                                    @if ($status === 'pending')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">
                                            <i data-lucide="clock-3" class="size-3 mr-1.5"></i> Pending
                                        </span>
                                    @elseif ($status === 'approved')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-blue-100 border-transparent text-blue-500 dark:bg-blue-500/20 dark:border-transparent">
                                            <i data-lucide="check-circle-2" class="size-3 mr-1.5"></i> Approved
                                        </span>
                                    @elseif ($status === 'denied')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">
                                            <i data-lucide="x-circle" class="size-3 mr-1.5"></i> Rejected
                                        </span>
                                    @elseif ($status === 'paid')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                                            <i data-lucide="badge-dollar-sign" class="size-3 mr-1.5"></i> Paid
                                        </span>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:border-transparent">
                                            {{ ucfirst($status ?? 'n/a') }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Submitted Date --}}
                                <td class="px-3.5 py-2.5">
                                    {{ optional($reimbursement->created_at)->format('M d, Y') ?? '-' }}
                                    <div class="text-xs text-slate-500">
                                        {{ optional($reimbursement->created_at)->diffForHumans() }}
                                    </div>
                                </td>

                                {{-- Employee Receipt --}}
                                <td class="px-3.5 py-2.5">
                                    @if ($employeeReceiptUrl)
                                        <button type="button"
                                                data-modal-target="employeeReceiptModal-{{ $reimbursement->id }}"
                                                class="text-xs text-custom-500 hover:underline">
                                            View
                                        </button>
                                    @else
                                        <span class="text-xs text-slate-400">None</span>
                                    @endif
                                </td>

                                {{-- HR Receipt --}}
                                <td class="px-3.5 py-2.5">
                                    @if ($hrReceiptUrl)
                                        <button type="button"
                                                data-modal-target="hrReceiptModal-{{ $reimbursement->id }}"
                                                class="text-xs text-custom-500 hover:underline">
                                            View
                                        </button>
                                    @else
                                        <span class="text-xs text-slate-400">None</span>
                                    @endif
                                </td>

                                {{-- Action (status update modal) --}}
                                <td class="px-3.5 py-2.5">
                                    <div class="flex justify-end gap-2">
                                        <button type="button"
                                                data-modal-target="hrStatusModal-{{ $reimbursement->id }}"
                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 text-slate-500 bg-slate-100 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                            <i data-lucide="settings-2" class="size-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Employee Receipt Modal --}}
                            @if ($employeeReceiptUrl)
                                <div id="employeeReceiptModal-{{ $reimbursement->id }}" modal-center
                                     class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600">
                                        <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                            <h5 class="text-16">Employee Receipt</h5>
                                            <button data-modal-close="employeeReceiptModal-{{ $reimbursement->id }}"
                                                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                <i data-lucide="x" class="w-5 h-5"></i>
                                            </button>
                                        </div>
                                        <div class="p-4 max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto">
                                            <p class="mb-3 text-sm text-slate-600 dark:text-zink-200">
                                                {{ $reimbursement->title ?? 'No title' }}
                                                — ₱ {{ number_format($reimbursement->amount, 2) }}
                                            </p>

                                            @if(in_array($empExt, ['jpg','jpeg','png','gif','webp']))
                                                <img
                                                    src="{{ $employeeReceiptUrl }}"
                                                    alt="Employee Receipt"
                                                    class="mt-2 max-h-[28rem] w-full object-contain rounded-md border border-slate-200">
                                            @elseif($empExt === 'pdf')
                                                <iframe
                                                    src="{{ $employeeReceiptUrl }}"
                                                    class="w-full h-[60vh] rounded-md border border-slate-200"
                                                    frameborder="0">
                                                </iframe>
                                            @else
                                                <p class="text-sm text-slate-600 dark:text-zink-200">
                                                    Unsupported file type.
                                                    <a href="{{ $employeeReceiptUrl }}"
                                                       target="_blank"
                                                       class="text-custom-500 hover:underline">
                                                        Download file
                                                    </a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- HR Receipt Modal --}}
                            @if ($hrReceiptUrl)
                                <div id="hrReceiptModal-{{ $reimbursement->id }}" modal-center
                                     class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600">
                                        <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                            <h5 class="text-16">HR Receipt</h5>
                                            <button data-modal-close="hrReceiptModal-{{ $reimbursement->id }}"
                                                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                                <i data-lucide="x" class="w-5 h-5"></i>
                                            </button>
                                        </div>
                                        <div class="p-4 max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto">
                                            <p class="mb-3 text-sm text-slate-600 dark:text-zink-200">
                                                {{ $reimbursement->title ?? 'No title' }}
                                                — ₱ {{ number_format($reimbursement->amount, 2) }}
                                            </p>

                                            @if(in_array($hrExt, ['jpg','jpeg','png','gif','webp']))
                                                <img
                                                    src="{{ $hrReceiptUrl }}"
                                                    alt="HR Receipt"
                                                    class="mt-2 max-h-[28rem] w-full object-contain rounded-md border border-slate-200">
                                            @elseif($hrExt === 'pdf')
                                                <iframe
                                                    src="{{ $hrReceiptUrl }}"
                                                    class="w-full h-[60vh] rounded-md border border-slate-200"
                                                    frameborder="0">
                                                </iframe>
                                            @else
                                                <p class="text-sm text-slate-600 dark:text-zink-200">
                                                    Unsupported file type.
                                                    <a href="{{ $hrReceiptUrl }}"
                                                       target="_blank"
                                                       class="text-custom-500 hover:underline">
                                                        Download file
                                                    </a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Status / Receipt Update Modal --}}
                            <div id="hrStatusModal-{{ $reimbursement->id }}" modal-center
                                 class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                                        <h5 class="text-16">Update Reimbursement Status</h5>
                                        <button data-modal-close="hrStatusModal-{{ $reimbursement->id }}"
                                                class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                        <form
                                            action="{{ route('hr.reimbursements.updateStatus', $reimbursement) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <p class="mb-3 text-sm text-slate-600 dark:text-zink-200">
                                                Employee:
                                                <span class="font-semibold">
                                                    {{ $reimbursement->employee->name ?? 'Unknown' }}
                                                </span><br>
                                                Amount:
                                                <span class="font-semibold">
                                                    ₱ {{ number_format($reimbursement->amount, 2) }}
                                                </span>
                                            </p>

                                            {{-- Status --}}
                                            <div class="mb-4">
                                                <label class="inline-block mb-2 text-base font-medium">
                                                    Status <span class="text-red-500">*</span>
                                                </label>
                                                <select name="status"
                                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:focus:border-custom-800">
                                                    <option value="pending"
                                                        @selected($reimbursement->status === 'pending')>
                                                        Pending
                                                    </option>
                                                    <option value="approved"
                                                        @selected($reimbursement->status === 'approved')>
                                                        Approved
                                                    </option>
                                                    <option value="denied"
                                                        @selected($reimbursement->status === 'denied')>
                                                        Rejected
                                                    </option>
                                                    <option value="paid"
                                                        @selected($reimbursement->status === 'paid')>
                                                        Paid
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- HR Payment Receipt --}}
                                            <div class="mb-4">
                                                <label class="inline-block mb-2 text-base font-medium">
                                                    Payment Receipt (HR)
                                                    <span class="text-xs text-slate-400">
                                                        (optional, usually when Paid)
                                                    </span>
                                                </label>
                                                <input type="file" name="hr_payment_receipt"
                                                       class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:focus:border-custom-800">
                                                <p class="mt-1 text-xs text-slate-500">
                                                    Allowed: JPG, PNG, PDF &nbsp;|&nbsp; Max 4MB
                                                </p>
                                                @error('hr_payment_receipt')
                                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                                @enderror

                                                @if ($hrReceiptUrl)
                                                    <p class="mt-1 text-xs">
                                                        Current:
                                                        <button type="button"
                                                                data-modal-target="hrReceiptModal-{{ $reimbursement->id }}"
                                                                class="text-custom-500 hover:underline">
                                                            View existing receipt
                                                        </button>
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="flex justify-end gap-2 mt-4">
                                                <button type="button"
                                                        data-modal-close="hrStatusModal-{{ $reimbursement->id }}"
                                                        class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-600 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="9" class="px-3.5 py-4 text-center text-sm text-slate-500">
                                    No reimbursements found.
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
@endsection

@section('script')
    {{-- DataTables + theme modal JS will handle the rest --}}
@endsection
