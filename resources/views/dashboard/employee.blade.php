@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            {{-- Page Header --}}
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Employee Dashboard</h5>
                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-200">
                        Welcome back,
                        <span class="font-semibold">
                            {{ auth()->user()->name ?? Session::get('name') ?? 'Employee' }}
                        </span>
                    </p>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
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

            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5 gap-y-5">

                {{-- LEFT COLUMN: Attendance + Tasks --}}
                <div class="col-span-12 lg:col-span-8 2xl:col-span-9 space-y-5">

                    {{-- Live Time + Attendance --}}
                    <div class="grid grid-cols-12 gap-5">

                        {{-- Live PHT Time --}}
                        <div class="col-span-12 md:col-span-6 card">
                            <div class="card-body">
                                <p class="text-slate-500 dark:text-slate-200 text-sm">Current Time (PHT)</p>
                                <h3 class="mt-2 mb-1 text-2xl font-semibold" id="pht-time-display">
                                    {{-- JS will update this in real-time --}}
                                    --
                                </h3>
                                <p class="text-xs text-slate-500 dark:text-zink-200" id="pht-date-display">--</p>
                                <p class="mt-3 text-xs text-slate-400 dark:text-zink-300">
                                    Timezone: Asia/Manila (UTC+8)
                                </p>
                            </div>
                        </div>

                        {{-- Attendance Card --}}
                        <div class="col-span-12 md:col-span-6 card">
                            <div class="card-body">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="text-slate-500 dark:text-slate-200 text-sm">Today Attendance</p>
                                        <h6 class="mt-1 text-15 font-semibold">
                                            {{ now('Asia/Manila')->format('M d, Y') }}
                                        </h6>
                                    </div>
                                    <div
                                        class="flex items-center justify-center rounded-full size-10 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                        <i data-lucide="clock-4" class="size-5"></i>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div>
                                        <p class="text-slate-500 dark:text-zink-200 text-xs mb-1">Sign In</p>
                                        <p class="font-medium">
                                            {{ optional($todayAttendance->sign_in_at ?? null)->timezone('Asia/Manila')->format('h:i A') ?? '--' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-slate-500 dark:text-zink-200 text-xs mb-1">Sign Out</p>
                                        <p class="font-medium">
                                            {{ optional($todayAttendance->sign_out_at ?? null)->timezone('Asia/Manila')->format('h:i A') ?? '--' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 mt-4">
                                    {{-- SIGN IN --}}
                                    <form action="{{ route('employee.attendance.signin') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs text-white btn bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600">
                                            Sign In
                                        </button>
                                    </form>

                                    {{-- SIGN OUT --}}
                                    <form action="{{ route('employee.attendance.signout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs text-white btn bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>

                                @if(!empty($todayAttendance->status))
                                    <p class="mt-3 text-xs text-slate-500 dark:text-zink-200">
                                        Status:
                                        <span class="font-semibold">{{ ucfirst($todayAttendance->status) }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- High Priority Tasks --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="flex items-center gap-2 mb-4">
                                <h6 class="text-15 grow">Your Tasks – High Priority</h6>
                                <span
                                    class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded-full border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/30">
                                    <i data-lucide="alert-triangle" class="size-3 mr-1.5"></i>
                                    High Priority
                                </span>
                            </div>

                            @if(isset($highPriorityTasks) && $highPriorityTasks->count())
                                <div class="-mx-5 overflow-x-auto">
                                    <table class="w-full whitespace-nowrap">
                                        <thead
                                            class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                        <tr>
                                            <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-xs border-y border-slate-200 dark:border-zink-500">
                                                Task
                                            </th>
                                            <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-xs border-y border-slate-200 dark:border-zink-500">
                                                Due Date
                                            </th>
                                            <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-xs border-y border-slate-200 dark:border-zink-500">
                                                Priority
                                            </th>
                                            <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-xs border-y border-slate-200 dark:border-zink-500">
                                                Status
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-xs border-y border-slate-200 dark:border-zink-500 ltr:text-right rtl:text-left">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($highPriorityTasks as $task)
                                            <tr class="border-y border-slate-200 dark:border-zink-500">
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5">
                                                    <div class="flex flex-col">
                                                        <span class="font-medium text-sm">
                                                            {{ $task->title }}
                                                        </span>
                                                        @if($task->description)
                                                            <span class="text-xs text-slate-500 dark:text-zink-200 line-clamp-2">
                                                                {{ $task->description }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 text-sm">
                                                    {{ optional($task->due_date)->timezone('Asia/Manila')->format('M d, Y') ?? '—' }}
                                                </td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5">
                                                    <span
                                                        class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20">
                                                        {{ ucfirst($task->priority ?? 'high') }}
                                                    </span>
                                                </td>
                                                <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 text-sm">
                                                    @php
                                                        $status = $task->status ?? 'pending';
                                                    @endphp

                                                    @if($status === 'completed')
                                                        <span
                                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">
                                                            Completed
                                                        </span>
                                                    @elseif($status === 'in_progress')
                                                        <span
                                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">
                                                            In Progress
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2.5 py-0.5 inline-block text-[11px] font-medium rounded border bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20">
                                                            Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 first:pl-5 last:pr-5 ltr:text-right rtl:text-left">
                                                    <div class="flex justify-end gap-2">
                                                        <a href="{{ route('employee.tasks.show', $task) }}"
                                                           class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 dark:bg-zink-600 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/20">
                                                            <i data-lucide="eye" class="size-4"></i>
                                                        </a>

                                                        @if(($task->status ?? 'pending') !== 'completed')
                                                            <form action="{{ route('employee.tasks.complete', $task) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                        class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-green-100 dark:bg-green-500/20 text-green-600 hover:bg-green-200">
                                                                    <i data-lucide="check" class="size-4"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-sm text-slate-500 dark:text-zink-200">
                                    You have no high priority tasks assigned at the moment.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Simple Summary (optional / static for now) --}}
                <div class="col-span-12 lg:col-span-4 2xl:col-span-3 space-y-5">

                    {{-- Quick Stats --}}
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3 text-15">Today Summary</h6>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zink-200">Tasks</p>
                                    <h5 class="mt-1 text-lg font-semibold">
                                        {{ $highPriorityTasks->count() ?? 0 }}
                                    </h5>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zink-200">Completed</p>
                                    <h5 class="mt-1 text-lg font-semibold">
                                        {{ $completedTodayCount ?? 0 }}
                                    </h5>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-zink-200">Pending</p>
                                    <h5 class="mt-1 text-lg font-semibold">
                                        {{ $pendingTodayCount ?? 0 }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Small Note / Help Card --}}
                    <div class="card">
                        <div class="card-body flex gap-3">
                            <div class="shrink-0">
                                <div
                                    class="flex items-center justify-center rounded-full size-10 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                                    <i data-lucide="info" class="size-5"></i>
                                </div>
                            </div>
                            <div class="grow">
                                <h6 class="mb-1 text-15">Reminder</h6>
                                <p class="text-xs text-slate-500 dark:text-zink-200">
                                    Don’t forget to <span class="font-semibold">sign out</span> at the end of your shift
                                    and mark completed tasks before leaving.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div> {{-- /grid --}}

        </div> {{-- /container-fluid --}}
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    {{-- Live PHT time (Asia/Manila) --}}
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
                const timeStr = now.toLocaleTimeString('en-PH', optionsTime);
                const dateStr = now.toLocaleDateString('en-PH', optionsDate);

                const timeEl = document.getElementById('pht-time-display');
                const dateEl = document.getElementById('pht-date-display');

                if (timeEl) timeEl.textContent = timeStr;
                if (dateEl) dateEl.textContent = dateStr;
            } catch (e) {
                // fallback
            }
        }

        updatePhtTime();
        setInterval(updatePhtTime, 1000);
    </script>
@endsection
