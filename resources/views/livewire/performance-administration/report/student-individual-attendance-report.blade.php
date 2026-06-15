<div class="space-y-5">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 via-white to-blue-50/60 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-900 dark:to-blue-950/20 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600 shadow-sm dark:border-blue-900/60 dark:bg-blue-950/40 dark:text-blue-300">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <div>
                    <h2 class="text-base font-semibold text-slate-950 dark:text-white">Student Attendance Summary</h2>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Aggregated attendance records across all payroll batches.</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                    {{ count($batchReports) }} {{ count($batchReports) === 1 ? 'Batch' : 'Batches' }}
                </span>

                <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Real-time Computed
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 divide-x divide-slate-100 dark:divide-slate-800 sm:grid-cols-4">
            <div class="px-5 py-3">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Present</p>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Complete logs
                </div>
            </div>
            <div class="px-5 py-3">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Partial</p>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                    Missing log
                </div>
            </div>
            <div class="px-5 py-3">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Absent</p>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                    No attendance
                </div>
            </div>
            <div class="px-5 py-3">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Late</p>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                    <span class="h-2 w-2 rounded-sm bg-orange-400"></span>
                    By severity
                </div>
            </div>
        </div>
    </div>

    {{-- ===== PER-BATCH CARDS ===== --}}
    <div class="space-y-5">
        @forelse ($batchReports as $batchId => $report)
        @php
        $trainingBatch = $report['batch'];
        $trainingScheduleItem = $report['scheduleItem'] ?? null;
        $dateRange = $report['dateRange'];
        $students = $report['students'];
        $attendanceMap = $report['attendanceMap'];
        @endphp

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm ring-1 ring-slate-950/[0.02] transition-shadow duration-200 hover:shadow-md dark:border-slate-800 dark:bg-slate-900 dark:ring-white/[0.03]">

            {{-- ===== HEADER ===== --}}
            <div class="border-b border-slate-100 bg-slate-50/80 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/55">
                <div class="flex flex-col gap-4 2xl:flex-row 2xl:items-start 2xl:justify-between">

                    {{-- Left: batch identity --}}
                    <div class="min-w-0">
                        <div class="flex items-start gap-3">
                            <div class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-white text-blue-600 shadow-sm dark:border-blue-900/60 dark:bg-slate-900 dark:text-blue-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                </svg>
                                <span class="absolute -right-1 -top-1 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-900"></span>
                            </div>

                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h2 class="truncate text-lg font-semibold text-slate-950 dark:text-white">
                                        {{ $trainingBatch->batch_name }}
                                    </h2>

                                    <span class="inline-flex items-center rounded-full border border-blue-100 bg-blue-50 px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wide text-blue-700 dark:border-blue-900/60 dark:bg-blue-950/30 dark:text-blue-300">
                                        {{ $trainingBatch->batch_code }}
                                    </span>
                                </div>

                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                    <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-2.5 py-1 dark:border-slate-700 dark:bg-slate-900">
                                        <svg class="h-3.5 w-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium text-slate-700 dark:text-slate-200">{{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }}</span>
                                        <span class="text-slate-300 dark:text-slate-600">–</span>
                                        <span class="font-medium text-slate-700 dark:text-slate-200">{{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}</span>
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-2.5 py-1 dark:border-slate-700 dark:bg-slate-900">
                                        <svg class="h-3.5 w-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z" />
                                        </svg>
                                        <span class="font-medium text-slate-700 dark:text-slate-200">{{ count($students) }}</span>
                                        students
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-2.5 py-1 dark:border-slate-700 dark:bg-slate-900">
                                        <svg class="h-3.5 w-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5a3 3 0 016 0" />
                                        </svg>
                                        <span class="font-medium text-slate-700 dark:text-slate-200">{{ count($dateRange) }}</span>
                                        scheduled days
                                    </span>

                                    @if($trainingScheduleItem)
                                    <span class="inline-flex items-center gap-1.5 rounded-full border border-orange-100 bg-orange-50 px-2.5 py-1 text-orange-700 dark:border-orange-900/60 dark:bg-orange-950/30 dark:text-orange-300">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Expected in: <span class="font-semibold">{{ \Carbon\Carbon::parse($trainingScheduleItem->start_time)->format('g:i A') }}</span>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right: legend --}}
                    <div class="flex shrink-0 flex-col gap-2 2xl:items-end">
                        <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-500 dark:text-slate-400">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-100 bg-emerald-50 px-2.5 py-1 dark:border-emerald-900/60 dark:bg-emerald-950/30">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                <span class="font-semibold text-emerald-700 dark:text-emerald-300">Present</span>
                                <span class="text-slate-400 dark:text-slate-500">1st In + 2nd Out</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-100 bg-amber-50 px-2.5 py-1 dark:border-amber-900/60 dark:bg-amber-950/30">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                <span class="font-semibold text-amber-700 dark:text-amber-300">Partial</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-100 bg-rose-50 px-2.5 py-1 dark:border-rose-900/60 dark:bg-rose-950/30">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                <span class="font-semibold text-rose-700 dark:text-rose-300">Absent</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-2.5 py-1 dark:border-slate-700 dark:bg-slate-900">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                <span class="font-semibold text-slate-500 dark:text-slate-400">No Record</span>
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-500 dark:text-slate-400">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-yellow-100 bg-white px-2.5 py-1 dark:border-yellow-900/60 dark:bg-slate-900">
                                <span class="inline-block h-1.5 w-1.5 rounded-sm border border-yellow-300 bg-yellow-200"></span>
                                <span class="font-semibold text-yellow-700 dark:text-yellow-300">Minor</span>
                                <span class="text-slate-400 dark:text-slate-500">1–10 min</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-orange-100 bg-white px-2.5 py-1 dark:border-orange-900/60 dark:bg-slate-900">
                                <span class="inline-block h-1.5 w-1.5 rounded-sm border border-orange-400 bg-orange-300"></span>
                                <span class="font-semibold text-orange-700 dark:text-orange-300">Moderate</span>
                                <span class="text-slate-400 dark:text-slate-500">11–30 min</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-100 bg-white px-2.5 py-1 dark:border-rose-900/60 dark:bg-slate-900">
                                <span class="inline-block h-1.5 w-1.5 rounded-sm border border-rose-600 bg-rose-500"></span>
                                <span class="font-semibold text-rose-700 dark:text-rose-300">Severe</span>
                                <span class="text-slate-400 dark:text-slate-500">31+ min</span>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ===== TABLE ===== --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-xs">

                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50 text-slate-500 dark:border-slate-800 dark:bg-slate-800/80">
                            <th class="sticky left-0 z-20 min-w-[230px] border-r border-slate-100 bg-slate-50 px-4 py-3 text-left text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-500">
                                Student
                            </th>
                            @foreach($dateRange as $date)
                            <th class="min-w-[154px] border-l border-slate-100 px-3 py-3 text-center dark:border-slate-800">
                                <div class="text-[11px] font-bold text-slate-700 dark:text-slate-200">
                                    {{ \Carbon\Carbon::parse($date)->format('M d') }}
                                </div>
                                <div class="mt-0.5 text-[10px] font-medium text-slate-400 dark:text-slate-500">
                                    {{ \Carbon\Carbon::parse($date)->format('D') }}
                                </div>
                            </th>
                            @endforeach
                            <th class="min-w-[76px] border-l border-slate-100 bg-emerald-50/80 px-3 py-3 text-center text-[10px] font-bold uppercase tracking-[0.18em] dark:border-slate-800 dark:bg-emerald-950/20">
                                <span class="text-emerald-600 dark:text-emerald-400">Present</span>
                            </th>
                            <th class="min-w-[76px] bg-rose-50/80 px-3 py-3 text-center text-[10px] font-bold uppercase tracking-[0.18em] dark:bg-rose-950/20">
                                <span class="text-rose-500 dark:text-rose-400">Absent</span>
                            </th>
                            <th class="min-w-[76px] bg-orange-50/80 px-3 py-3 text-center text-[10px] font-bold uppercase tracking-[0.18em] dark:bg-orange-950/20">
                                <span class="text-orange-500 dark:text-orange-400">Lates</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                        @forelse($students as $student)
                        @php
                        $presentCount = 0;
                        $absentCount = 0;
                        $lateCount = 0;
                        @endphp

                        <tr class="group align-top transition-colors duration-150 odd:bg-white even:bg-slate-50/30 hover:bg-blue-50/40 dark:odd:bg-slate-900 dark:even:bg-slate-800/20 dark:hover:bg-blue-950/20">

                            <td class="sticky left-0 z-10 border-r border-slate-100 bg-inherit px-4 py-3 transition-colors dark:border-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-blue-100 bg-blue-50 shadow-sm dark:border-blue-900/60 dark:bg-blue-950/30">
                                        <span class="text-[11px] font-bold text-blue-700 dark:text-blue-300">
                                            {{ strtoupper(substr($student['student_name'], 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block truncate text-xs font-semibold leading-tight text-slate-800 dark:text-slate-100">{{ $student['student_name'] }}</span>
                                        <span class="mt-0.5 block text-[10px] font-medium uppercase tracking-wider text-slate-400 dark:text-slate-500">Learner</span>
                                    </div>
                                </div>
                            </td>

                            @foreach($dateRange as $date)
                            @php
                            $record = $attendanceMap[$student['batch_student_id']][$date] ?? null;
                            $overall = $record['status'] ?? 'none';
                            $isLate = $record['is_late'] ?? false;
                            $minLate = $record['minutes_late'] ?? 0;
                            $severity = $record['severity'] ?? null;

                            if (in_array($overall, ['present','partial'])) $presentCount++;
                            if ($overall === 'absent') $absentCount++;
                            if ($isLate) $lateCount++;

                            $dotColor = match($overall) {
                            'present' => 'bg-emerald-500 ring-emerald-100 dark:ring-emerald-900/50',
                            'partial' => 'bg-amber-400 ring-amber-100 dark:ring-amber-900/50',
                            'absent' => 'bg-rose-500 ring-rose-100 dark:ring-rose-900/50',
                            default => 'bg-slate-300 ring-slate-100 dark:bg-slate-600 dark:ring-slate-700',
                            };

                            $cellBg = $overall === 'absent' ? 'bg-rose-50/50 dark:bg-rose-950/10' : '';

                            $lateBadge = match($severity) {
                            'severe' => 'border border-rose-100 bg-rose-50 text-rose-700 shadow-sm dark:border-rose-900/60 dark:bg-rose-950/30 dark:text-rose-300',
                            'moderate' => 'border border-orange-100 bg-orange-50 text-orange-700 shadow-sm dark:border-orange-900/60 dark:bg-orange-950/30 dark:text-orange-300',
                            'minor' => 'border border-yellow-100 bg-yellow-50 text-yellow-700 shadow-sm dark:border-yellow-900/60 dark:bg-yellow-950/30 dark:text-yellow-300',
                            default => '',
                            };
                            @endphp

                            <td class="border-l border-slate-100 px-3 py-3 align-top dark:border-slate-800 {{ $cellBg }}">
                                @if($record)
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex min-w-0 items-center gap-1.5">
                                            <span class="h-2 w-2 shrink-0 rounded-full ring-4 {{ $dotColor }}"></span>

                                            @if($overall === 'absent')
                                            <span class="truncate text-[10px] font-semibold text-rose-600 dark:text-rose-400">Absent</span>
                                            @elseif($overall === 'partial')
                                            <span class="truncate text-[10px] font-semibold text-amber-600 dark:text-amber-400">Partial</span>
                                            @elseif($overall === 'present')
                                            <span class="truncate text-[10px] font-semibold text-emerald-600 dark:text-emerald-400">Present</span>
                                            @endif
                                        </div>

                                        @if($isLate && $severity)
                                        <span class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-bold {{ $lateBadge }}">
                                            +{{ $minLate }}m
                                        </span>
                                        @endif
                                    </div>

                                    @if($record['am']['check_in'] || $record['am']['check_out'])
                                    <div class="space-y-1 rounded-xl border border-slate-100 bg-white px-2.5 py-2 shadow-sm dark:border-slate-700 dark:bg-slate-800/80">
                                        <div class="flex items-center justify-between">
                                            <p class="text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400 dark:text-slate-500">AM</p>
                                            @if($isLate)
                                            <span class="rounded-full bg-orange-50 px-1.5 py-0.5 text-[9px] font-bold text-orange-600 dark:bg-orange-950/30 dark:text-orange-300">Late</span>
                                            @endif
                                        </div>

                                        @if($record['am']['check_in'])
                                        <div class="flex items-center gap-1.5 {{ $isLate ? 'text-orange-600 dark:text-orange-300' : 'text-slate-700 dark:text-slate-200' }}">
                                            <svg class="h-3 w-3 shrink-0 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                                            </svg>
                                            <span class="text-[10px] font-bold">{{ $record['am']['check_in'] }}</span>
                                        </div>
                                        @endif

                                        @if($record['am']['check_out'])
                                        <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500">
                                            <svg class="h-3 w-3 shrink-0 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                            <span class="text-[10px] font-medium">{{ $record['am']['check_out'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif

                                    @if($record['pm']['check_in'] || $record['pm']['check_out'])
                                    <div class="space-y-1 rounded-xl border border-blue-100 bg-blue-50/60 px-2.5 py-2 shadow-sm dark:border-blue-900/60 dark:bg-blue-950/20">
                                        <p class="text-[9px] font-bold uppercase tracking-[0.16em] text-blue-400 dark:text-blue-500">PM</p>

                                        @if($record['pm']['check_in'])
                                        <div class="flex items-center gap-1.5 text-blue-700 dark:text-blue-300">
                                            <svg class="h-3 w-3 shrink-0 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                                            </svg>
                                            <span class="text-[10px] font-bold">{{ $record['pm']['check_in'] }}</span>
                                        </div>
                                        @endif

                                        @if($record['pm']['check_out'])
                                        <div class="flex items-center gap-1.5 text-blue-500 dark:text-blue-400">
                                            <svg class="h-3 w-3 shrink-0 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                            <span class="text-[10px] font-medium">{{ $record['pm']['check_out'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="flex h-full min-h-[36px] items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/50 text-slate-300 dark:border-slate-700 dark:bg-slate-800/30 dark:text-slate-600">
                                    <span class="select-none text-xs">—</span>
                                </div>
                                @endif
                            </td>
                            @endforeach

                            <td class="border-l border-slate-100 bg-emerald-50/50 px-3 py-3 text-center align-top dark:border-slate-800 dark:bg-emerald-950/10">
                                <span class="inline-flex h-7 min-w-7 items-center justify-center rounded-full border border-emerald-100 bg-white px-2 text-xs font-bold text-emerald-600 shadow-sm dark:border-emerald-900/60 dark:bg-slate-900 dark:text-emerald-400">{{ $presentCount }}</span>
                            </td>
                            <td class="bg-rose-50/50 px-3 py-3 text-center align-top dark:bg-rose-950/10">
                                <span class="inline-flex h-7 min-w-7 items-center justify-center rounded-full border border-rose-100 bg-white px-2 text-xs font-bold text-rose-500 shadow-sm dark:border-rose-900/60 dark:bg-slate-900 dark:text-rose-400">{{ $absentCount }}</span>
                            </td>
                            <td class="bg-orange-50/50 px-3 py-3 text-center align-top dark:bg-orange-950/10">
                                <span class="inline-flex h-7 min-w-7 items-center justify-center rounded-full border border-orange-100 bg-white px-2 text-xs font-bold text-orange-500 shadow-sm dark:border-orange-900/60 dark:bg-slate-900 dark:text-orange-400">{{ $lateCount }}</span>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="{{ count($dateRange) + 4 }}" class="px-5 py-16 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                                        <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">No students enrolled</p>
                                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">No students found in this training batch.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                    @if(count($students) > 0)
                    <tfoot class="border-t border-slate-100 bg-slate-50 dark:border-slate-800 dark:bg-slate-800/80">
                        <tr>
                            <td class="sticky left-0 border-r border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800">
                                <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                                    <span><span class="font-bold text-slate-700 dark:text-slate-200">{{ count($students) }}</span> students</span>
                                    <span class="h-1 w-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                    <span><span class="font-bold text-slate-700 dark:text-slate-200">{{ count($dateRange) }}</span> scheduled days</span>
                                </span>
                            </td>
                            @foreach($dateRange as $date)
                            <td class="border-l border-slate-100 py-3 dark:border-slate-800"></td>
                            @endforeach
                            <td class="border-l border-slate-100 bg-emerald-50/50 dark:border-slate-800 dark:bg-emerald-950/10"></td>
                            <td class="bg-rose-50/50 dark:bg-rose-950/10"></td>
                            <td class="bg-orange-50/50 dark:bg-orange-950/10"></td>
                        </tr>
                    </tfoot>
                    @endif

                </table>
            </div>

        </div>{{-- end single batch --}}
        @empty
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-8 0h8m-8 0H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">No attendance batches found</p>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">There are no payroll batches available for this report.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>{{-- end space-y-5 batches --}}

</div>{{-- end outer space-y-5 --}}