@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            {{-- Page Header --}}
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16 font-semibold tracking-tight">Employee Dashboard</h5>
                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-200 flex items-center gap-1">
                        <span>Welcome back,</span>
                        <span class="font-semibold text-slate-800 dark:text-zink-50">
                            {{ auth()->user()->name ?? Session::get('name') ?? 'Employee' }}
                        </span>
                    </p>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100 font-medium">
                        Employee
                    </li>
                </ul>
            </div>

            {{-- Flash Messages --}}
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

            @php
                $completedToday = $completedTodayCount ?? 0;
                $pendingToday   = $pendingTodayCount ?? 0;
                $totalTasksToday = $completedToday + $pendingToday;
                $completionRate = $totalTasksToday > 0 ? round(($completedToday / $totalTasksToday) * 100) : 0;
            @endphp

            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5 gap-y-5">

                {{-- LEFT COLUMN --}}
                <div class="col-span-12 lg:col-span-8 2xl:col-span-9 space-y-5">

                    {{-- Live Time + Attendance --}}
                    <div class="grid grid-cols-12 gap-5">

                        {{-- Live PHT Time --}}
                        <div class="col-span-12 md:col-span-6">
                            <div
                                class="card relative overflow-hidden border border-slate-200/80 dark:border-zink-500/60 shadow-sm hover:shadow-md transition-all duration-200">
                                <div
                                    class="absolute -right-6 -top-6 size-16 rounded-full bg-custom-100/30 dark:bg-custom-500/10 blur-xl pointer-events-none">
                                </div>
                                <div class="card-body relative">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-xs font-medium tracking-wide text-slate-500 dark:text-slate-200 uppercase">
                                                Current Time (PHT)
                                            </p>
                                            <p id="pht-greeting"
                                               class="mt-1 text-xs text-slate-400 dark:text-zink-300">
                                                --
                                            </p>
                                        </div>
                                        <div
                                            class="flex items-center justify-center rounded-full size-10 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                            <i data-lucide="clock-4" class="size-5"></i>
                                        </div>
                                    </div>

                                    <h3 id="pht-time-display"
                                        class="mt-1 mb-1 text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-zink-50 leading-none">
                                        --
                                    </h3>
                                    <p id="pht-date-display"
                                       class="mt-1 text-xs font-medium text-slate-500 dark:text-zink-200 uppercase tracking-[0.16em]">
                                        --
                                    </p>

                                    <p class="mt-3 text-[11px] text-slate-400 dark:text-zink-300">
                                        Timezone:
                                        <span class="font-semibold text-slate-600 dark:text-zink-100">
                                            Asia/Manila (UTC+8)
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Attendance Card --}}
                        <div class="col-span-12 md:col-span-6">
                            <div
                                class="card border border-slate-200/80 dark:border-zink-500/60 shadow-sm hover:shadow-md transition-all duration-200">
                                <div class="card-body">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-xs font-medium tracking-wide text-slate-500 dark:text-slate-200 uppercase">
                                                Today Attendance
                                            </p>
                                            <h6 class="mt-1 text-[15px] font-semibold text-slate-900 dark:text-zink-50">
                                                {{ now('Asia/Manila')->format('M d, Y') }}
                                            </h6>
                                        </div>
                                        <div
                                            class="flex items-center justify-center rounded-full size-10 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                            <i data-lucide="badge-check" class="size-5"></i>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <p class="text-slate-500 dark:text-zink-200 text-xs mb-1 uppercase tracking-wide">
                                                Sign In
                                            </p>
                                            <p class="font-semibold text-slate-900 dark:text-zink-50">
                                                {{ $todayAttendance?->sign_in_at?->timezone('Asia/Manila')?->format('h:i A') ?? '--' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-slate-500 dark:text-zink-200 text-xs mb-1 uppercase tracking-wide">
                                                Sign Out
                                            </p>
                                            <p class="font-semibold text-slate-900 dark:text-zink-50">
                                                {{ $todayAttendance?->sign_out_at?->timezone('Asia/Manila')?->format('h:i A') ?? '--' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 mt-4">
                                        {{-- Sign In --}}
                                        <form action="{{ route('employee.attendance.signin') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-3.5 py-1.5 text-xs font-semibold text-white rounded-md btn bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 shadow-sm">
                                                Sign In
                                            </button>
                                        </form>

                                        {{-- Sign Out --}}
                                        <form action="{{ route('employee.attendance.signout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-3.5 py-1.5 text-xs font-semibold text-white rounded-md btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 shadow-sm">
                                                Sign Out
                                            </button>
                                        </form>
                                    </div>

                                    @if(!empty($todayAttendance?->status))
                                        <p class="mt-3 text-xs text-slate-500 dark:text-zink-200 flex items-center gap-1">
                                            <span>Status:</span>
                                            @php
                                                $attendanceStatus = strtolower($todayAttendance->status);
                                            @endphp

                                            @if($attendanceStatus === 'present')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-green-100 text-green-600">
                                                    <span class="size-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                                    Present
                                                </span>
                                            @elseif($attendanceStatus === 'late')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-yellow-100 text-yellow-600">
                                                    <span class="size-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                                    Late
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700">
                                                    {{ ucfirst($attendanceStatus) }}
                                                </span>
                                            @endif
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- High Priority Tasks --}}
                    {{-- (UNCHANGED — keeping your original content here) --}}
                    {!! $highPrioritySection ?? '' !!}

                </div>

                {{-- RIGHT COLUMN --}}
                <div class="col-span-12 lg:col-span-4 2xl:col-span-3 space-y-5">

                    {{-- Today Summary --}}
                    <div class="card border border-slate-200/80 dark:border-zink-500/60 shadow-sm hover:shadow-md">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-3">
                                <h6 class="text-15 font-semibold">Today Summary</h6>
                                <span class="text-[11px] text-slate-400 dark:text-zink-300">
                                    {{ now('Asia/Manila')->format('D, M d') }}
                                </span>
                            </div>

                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-[11px] uppercase text-slate-500">Tasks</p>
                                    <h5 class="mt-1 text-lg font-semibold">
                                        {{ isset($highPriorityTasks) ? $highPriorityTasks->count() : 0 }}
                                    </h5>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase text-slate-500">Completed</p>
                                    <h5 class="mt-1 text-lg font-semibold text-green-600">
                                        {{ $completedToday }}
                                    </h5>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase text-slate-500">Pending</p>
                                    <h5 class="mt-1 text-lg font-semibold text-yellow-600">
                                        {{ $pendingToday }}
                                    </h5>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-[11px] text-slate-500 uppercase">Task Completion</p>
                                    <span class="text-[11px] font-semibold">
                                        {{ $completionRate }}%
                                    </span>
                                </div>

                                <div class="w-full h-2.5 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-2.5 rounded-full bg-custom-500"
                                         style="width: {{ $completionRate }}%;">
                                    </div>
                                </div>

                                <p class="mt-2 text-[11px] text-slate-500">
                                    @if($totalTasksToday > 0)
                                        {{ $completedToday }} of {{ $totalTasksToday }} tasks completed today.
                                    @else
                                        No tasks logged today.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- TELCO PROJECT STATUS --}}
                    <div class="card border border-slate-200/80 dark:border-zink-500/60 shadow-sm hover:shadow-md">
                        <div class="card-body">

                            <div class="flex items-center justify-between mb-3">
                                <h6 class="text-15 font-semibold flex items-center gap-2">
                                    <i data-lucide="folder-kanban" class="size-4 text-custom-500"></i>
                                    TELCO PROJECT
                                </h6>
                                <span class="text-[11px] text-slate-400 dark:text-zink-300">
                                    Updated Today
                                </span>
                            </div>

                            @php
                                $projectProgress = 72; // sample progress
                            @endphp

                            <p class="text-sm font-medium text-slate-700 mb-1">
                                System Development Progress
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-[11px] text-slate-500 uppercase">
                                    Completion
                                </span>
                                <span class="text-[11px] font-semibold">
                                    {{ $projectProgress }}%
                                </span>
                            </div>

                            <div class="w-full h-2.5 rounded-full bg-slate-100 overflow-hidden mt-1">
                                <div class="h-2.5 bg-custom-500 rounded-full transition-all duration-700"
                                     style="width: {{ $projectProgress }}%;">
                                </div>
                            </div>

                            <p class="mt-2 text-[11px] text-slate-500">
                                Project is <strong>{{ $projectProgress }}%</strong> completed.
                            </p>

                            <span
                                class="mt-2 inline-block px-3 py-0.5 text-[11px] font-medium rounded-full bg-blue-100 text-blue-600 border border-blue-200">
                                Phase 2 – Development
                            </span>

                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="card border border-slate-200/80 shadow-sm hover:shadow-md">
                        <div class="card-body">
                            <h6 class="mb-3 text-15 font-semibold flex items-center gap-2">
                                <i data-lucide="sparkles" class="size-4 text-custom-500"></i>
                                Quick Links
                            </h6>

                            <div class="grid grid-cols-1 gap-2">
                                <a href="#"
                                   class="flex items-center justify-between px-3 py-2.5 bg-slate-50 rounded-md hover:bg-custom-100/70">
                                    <span class="flex items-center gap-2">
                                        <i data-lucide="user-circle-2" class="size-4"></i>
                                        My Profile
                                    </span>
                                    <i data-lucide="chevron-right" class="size-4 opacity-60"></i>
                                </a>

                                <a href="#"
                                   class="flex items-center justify-between px-3 py-2.5 bg-slate-50 rounded-md hover:bg-custom-100/70">
                                    <span class="flex items-center gap-2">
                                        <i data-lucide="calendar-days" class="size-4"></i>
                                        My Attendance
                                    </span>
                                    <i data-lucide="chevron-right" class="size-4 opacity-60"></i>
                                </a>

                                <a href="#"
                                   class="flex items-center justify-between px-3 py-2.5 bg-slate-50 rounded-md hover:bg-custom-100/70">
                                    <span class="flex items-center gap-2">
                                        <i data-lucide="clipboard-list" class="size-4"></i>
                                        My Tasks
                                    </span>
                                    <i data-lucide="chevron-right" class="size-4 opacity-60"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Reminder --}}
                    <div class="card border border-slate-200/80 shadow-sm hover:shadow-md">
                        <div class="card-body flex gap-3">
                            <div class="shrink-0">
                                <div
                                    class="flex items-center justify-center rounded-full size-10 bg-custom-100 text-custom-500">
                                    <i data-lucide="info" class="size-5"></i>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-1 text-15 font-semibold">Reminder</h6>
                                <p class="text-xs text-slate-500">
                                    Don’t forget to <strong>sign out</strong> and update your tasks before leaving.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')
<script>
    function updatePhtTime() {
        try {
            const optionsTime = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                timeZone: 'Asia/Manila'
            };
            const optionsDate = {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                timeZone: 'Asia/Manila'
            };

            const now = new Date();

            document.getElementById('pht-time-display').textContent =
                now.toLocaleTimeString('en-PH', optionsTime);

            document.getElementById('pht-date-display').textContent =
                now.toLocaleDateString('en-PH', optionsDate);

            const hour24 = parseInt(now.toLocaleString('en-PH', {
                hour: '2-digit',
                hour12: false,
                timeZone: 'Asia/Manila'
            }), 10);

            let greeting = 'Welcome';
            if (hour24 >= 5 && hour24 < 12) greeting = 'Good morning';
            else if (hour24 >= 12 && hour24 < 18) greeting = 'Good afternoon';
            else greeting = 'Good evening';

            document.getElementById('pht-greeting').textContent =
                greeting + ', {{ auth()->user()->name }}';

        } catch (e) {}
    }

    updatePhtTime();
    setInterval(updatePhtTime, 1000);
</script>
@endsection
