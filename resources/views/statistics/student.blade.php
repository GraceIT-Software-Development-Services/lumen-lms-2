<x-layouts.app.flowbite>
     @if(!empty($tardiness))
     @php
     $attendancePct = $absences['total_days'] > 0
     ? round((($absences['total_days'] - $absences['total_absent']) / $absences['total_days']) * 100, 1)
     : 100;

     $attendanceRate = 100 - $absences['absent_pct'];

     $riskLabel = 'No Issues';
     $riskBadge = 'border-slate-200 bg-white text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300';
     $riskDot = 'bg-slate-400';

     if ($tardiness['severe'] > 0 || $absences['absent_pct'] >= 20) {
     $riskLabel = 'High Risk';
     $riskBadge = 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300';
     $riskDot = 'bg-rose-500';
     } elseif ($tardiness['moderate'] > 0 || $absences['absent_pct'] >= 10) {
     $riskLabel = 'Moderate Risk';
     $riskBadge = 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300';
     $riskDot = 'bg-amber-500';
     } elseif ($tardiness['minor'] > 0) {
     $riskLabel = 'Low Risk';
     $riskBadge = 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300';
     $riskDot = 'bg-emerald-500';
     }

     $healthLabel = $attendancePct >= 90 ? 'Excellent' : ($attendancePct >= 75 ? 'Fair' : 'Poor');
     $healthColor = $attendancePct >= 90
     ? 'text-emerald-600 dark:text-emerald-400'
     : ($attendancePct >= 75 ? 'text-amber-600 dark:text-amber-400' : 'text-rose-600 dark:text-rose-400');
     $healthBadge = $attendancePct >= 90
     ? 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300'
     : ($attendancePct >= 75
     ? 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300'
     : 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300');

     $absenceStatus = $absences['absent_pct'] >= 20 ? 'Critical' : ($absences['absent_pct'] >= 10 ? 'Needs Attention' : 'Acceptable');
     $absenceStatusColor = $absences['absent_pct'] >= 20
     ? 'text-rose-600 dark:text-rose-400'
     : ($absences['absent_pct'] >= 10 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400');
     @endphp

     <div class="space-y-5">

          {{-- Header --}}
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
               <div class="flex flex-col gap-4 bg-gradient-to-br from-slate-50 via-white to-blue-50/60 px-5 py-5 sm:flex-row sm:items-center sm:justify-between dark:from-slate-900 dark:via-slate-900 dark:to-blue-950/20">
                    <div class="flex items-start gap-3">
                         <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600 shadow-sm dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                              </svg>
                         </div>
                         <div>
                              <h2 class="text-base font-semibold tracking-tight text-slate-950 dark:text-white">Tardiness & Absences Summary</h2>
                              <p class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">Aggregated across all payroll batches with risk status, attendance health, and absence details.</p>
                         </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 sm:justify-end">
                         <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-semibold shadow-sm {{ $riskBadge }}">
                              <span class="h-1.5 w-1.5 rounded-full {{ $riskDot }}"></span>
                              {{ $riskLabel }}
                         </span>
                         <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                              {{ $tardiness['total_batches'] }} payroll batches
                         </span>
                    </div>
               </div>
          </div>

          {{-- Top KPI Row --}}
          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">

               {{-- Total Batches --}}
               <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-150 hover:-translate-y-0.5 hover:shadow-md dark:border-slate-800 dark:bg-slate-900">
                    <div class="p-5">
                         <div class="flex items-start justify-between gap-3">
                              <div>
                                   <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Total Batches</p>
                                   <p class="mt-2 text-4xl font-bold tabular-nums text-slate-900 dark:text-white">{{ $tardiness['total_batches'] }}</p>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">payroll periods</p>
                              </div>
                              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v11.25A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75z" />
                                   </svg>
                              </div>
                         </div>
                         <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Avg. late / batch</span>
                                   <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $tardiness['total_batches'] > 0 ? round($tardiness['total_late'] / $tardiness['total_batches'], 1) : 0 }}×</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Avg. absent / batch</span>
                                   <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}×</span>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Late Arrivals --}}
               <div class="overflow-hidden rounded-2xl border border-amber-100 bg-white shadow-sm transition duration-150 hover:-translate-y-0.5 hover:shadow-md dark:border-amber-900/40 dark:bg-slate-900">
                    <div class="p-5">
                         <div class="flex items-start justify-between gap-3">
                              <div>
                                   <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Late Arrivals</p>
                                   <p class="mt-2 text-4xl font-bold tabular-nums text-amber-600 dark:text-amber-400">{{ $tardiness['total_late'] }}</p>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">instances across all batches</p>
                              </div>
                              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-amber-100 bg-amber-50 text-amber-600 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                   </svg>
                              </div>
                         </div>
                         <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="inline-flex items-center gap-1.5 text-slate-500 dark:text-slate-400"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Minor (1–15 min)</span>
                                   <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $tardiness['minor'] }}×</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="inline-flex items-center gap-1.5 text-slate-500 dark:text-slate-400"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Moderate (16–30 min)</span>
                                   <span class="font-semibold text-amber-600 dark:text-amber-400">{{ $tardiness['moderate'] }}×</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="inline-flex items-center gap-1.5 text-slate-500 dark:text-slate-400"><span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Severe (30+ min)</span>
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $tardiness['severe'] }}×</span>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Avg Minutes Late --}}
               <div class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition duration-150 hover:-translate-y-0.5 hover:shadow-md dark:border-orange-900/40 dark:bg-slate-900">
                    <div class="p-5">
                         <div class="flex items-start justify-between gap-3">
                              <div>
                                   <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Avg. Minutes Late</p>
                                   <div class="mt-2 flex items-baseline gap-1">
                                        <p class="text-4xl font-bold tabular-nums text-orange-600 dark:text-orange-400">{{ $tardiness['avg_minutes'] }}</p>
                                        <span class="text-sm font-semibold text-orange-500 dark:text-orange-300">min</span>
                                   </div>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">per late instance</p>
                              </div>
                              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-orange-50 text-orange-600 dark:border-orange-900/50 dark:bg-orange-950/30 dark:text-orange-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                   </svg>
                              </div>
                         </div>
                         <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Worst severity</span>
                                   @if($tardiness['severe'] > 0)
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">Severe</span>
                                   @elseif($tardiness['moderate'] > 0)
                                   <span class="font-semibold text-amber-600 dark:text-amber-400">Moderate</span>
                                   @elseif($tardiness['minor'] > 0)
                                   <span class="font-semibold text-emerald-600 dark:text-emerald-400">Minor</span>
                                   @else
                                   <span class="font-semibold text-slate-500 dark:text-slate-400">None</span>
                                   @endif
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Minor share</span>
                                   <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $tardiness['minor_pct'] }}%</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Severe share</span>
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $tardiness['severe_pct'] }}%</span>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Total Absences --}}
               <div class="overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm transition duration-150 hover:-translate-y-0.5 hover:shadow-md dark:border-rose-900/40 dark:bg-slate-900">
                    <div class="p-5">
                         <div class="flex items-start justify-between gap-3">
                              <div>
                                   <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Total Absences</p>
                                   <div class="mt-2 flex items-baseline gap-1">
                                        <p class="text-4xl font-bold tabular-nums text-rose-600 dark:text-rose-400">{{ $absences['total_absent'] }}</p>
                                        <span class="text-sm font-medium text-slate-400 dark:text-slate-500">/ {{ $absences['total_days'] }} days</span>
                                   </div>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">scheduled days across all batches</p>
                              </div>
                              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                   </svg>
                              </div>
                         </div>
                         <div class="mt-4 space-y-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Absence rate</span>
                                   <span class="font-semibold {{ $absences['absent_pct'] >= 20 ? 'text-rose-600 dark:text-rose-400' : ($absences['absent_pct'] >= 10 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400') }}">{{ $absences['absent_pct'] }}%</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Attendance rate</span>
                                   <span class="font-semibold {{ $attendanceRate >= 90 ? 'text-emerald-600 dark:text-emerald-400' : ($attendanceRate >= 75 ? 'text-amber-600 dark:text-amber-400' : 'text-rose-600 dark:text-rose-400') }}">{{ $attendanceRate }}%</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-slate-500 dark:text-slate-400">Days present</span>
                                   <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $absences['total_days'] - $absences['total_absent'] }}</span>
                              </div>
                         </div>
                    </div>
               </div>

          </div>

          {{-- Second Row: Attendance Health + Tardiness Breakdown --}}
          <div class="grid grid-cols-1 gap-4 xl:grid-cols-5">

               {{-- Attendance Health --}}
               <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-2">
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 bg-slate-50/80 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/60">
                         <div class="flex items-center gap-3">
                              <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                   </svg>
                              </div>
                              <div>
                                   <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Attendance Health</p>
                                   <p class="mt-0.5 text-[11px] text-slate-400 dark:text-slate-500">Present days versus scheduled days</p>
                              </div>
                         </div>
                         <span class="rounded-full border px-3 py-1 text-xs font-bold {{ $healthBadge }}">{{ $healthLabel }}</span>
                    </div>

                    <div class="p-5">
                         <div class="flex items-end justify-between gap-4">
                              <div>
                                   <p class="text-5xl font-bold tracking-tight tabular-nums {{ $healthColor }}">{{ $attendancePct }}%</p>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">attendance rate</p>
                              </div>
                              <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-right dark:border-slate-700 dark:bg-slate-800/70">
                                   <p class="text-xs text-slate-500 dark:text-slate-400">Days present</p>
                                   <p class="mt-1 text-lg font-bold text-slate-900 dark:text-white">{{ $absences['total_days'] - $absences['total_absent'] }} <span class="text-xs font-medium text-slate-400">of {{ $absences['total_days'] }}</span></p>
                              </div>
                         </div>

                         <div class="mt-5 grid grid-cols-1 gap-2 sm:grid-cols-2">
                              <div class="rounded-xl border border-slate-100 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-950/30">
                                   <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-500 dark:text-slate-400">Days absent / AWOL</span>
                                        <span class="font-bold text-rose-600 dark:text-rose-400">{{ $absences['total_absent'] }}</span>
                                   </div>
                              </div>
                              <div class="rounded-xl border border-slate-100 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-950/30">
                                   <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-500 dark:text-slate-400">Absence rate</span>
                                        <span class="font-bold {{ $absences['absent_pct'] >= 20 ? 'text-rose-600 dark:text-rose-400' : ($absences['absent_pct'] >= 10 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400') }}">{{ $absences['absent_pct'] }}%</span>
                                   </div>
                              </div>
                              <div class="rounded-xl border border-slate-100 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-950/30">
                                   <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-500 dark:text-slate-400">Total payroll batches</span>
                                        <span class="font-bold text-slate-800 dark:text-slate-200">{{ $tardiness['total_batches'] }}</span>
                                   </div>
                              </div>
                              <div class="rounded-xl border border-slate-100 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-950/30">
                                   <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-500 dark:text-slate-400">Avg. absences / batch</span>
                                        <span class="font-bold text-slate-800 dark:text-slate-200">{{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}</span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Tardiness Severity Breakdown --}}
               <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-3">
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 bg-slate-50/80 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/60">
                         <div class="flex items-center gap-3">
                              <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-amber-100 bg-amber-50 text-amber-600 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                   </svg>
                              </div>
                              <div>
                                   <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Tardiness Breakdown</p>
                                   <p class="mt-0.5 text-[11px] text-slate-400 dark:text-slate-500">Minor, moderate, and severe late arrivals</p>
                              </div>
                         </div>
                         <span class="hidden rounded-full border border-amber-100 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300 sm:inline-flex">{{ $tardiness['avg_minutes'] }} min avg.</span>
                    </div>

                    @if($tardiness['total_late'] > 0)
                    <div class="p-5">
                         <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                              <div>
                                   <p class="text-5xl font-bold tracking-tight tabular-nums text-amber-600 dark:text-amber-400">{{ $tardiness['total_late'] }}</p>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">total late instances</p>
                              </div>
                              <div class="rounded-2xl border border-orange-100 bg-orange-50 px-4 py-3 text-right dark:border-orange-900/50 dark:bg-orange-950/30">
                                   <p class="text-xs text-orange-700/70 dark:text-orange-300/80">Average late time</p>
                                   <p class="mt-1 text-2xl font-bold tabular-nums text-orange-600 dark:text-orange-300">{{ $tardiness['avg_minutes'] }}<span class="text-sm font-semibold text-orange-400"> min</span></p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                              {{-- Minor --}}
                              <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/20">
                                   <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-2">
                                             <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                             <div>
                                                  <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">Minor</p>
                                                  <p class="text-[11px] text-slate-500 dark:text-slate-400">1–15 mins late</p>
                                             </div>
                                        </div>
                                        <p class="text-lg font-bold tabular-nums text-emerald-600 dark:text-emerald-400">{{ $tardiness['minor'] }}×</p>
                                   </div>
                                   <div class="mt-3 border-t border-emerald-100 pt-3 text-xs text-slate-500 dark:border-emerald-900/50 dark:text-slate-400">
                                        <span class="font-semibold text-emerald-700 dark:text-emerald-300">{{ $tardiness['minor_pct'] }}%</span> of late records
                                   </div>
                              </div>

                              {{-- Moderate --}}
                              <div class="rounded-2xl border border-amber-100 bg-amber-50/50 p-4 dark:border-amber-900/50 dark:bg-amber-950/20">
                                   <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-2">
                                             <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                                             <div>
                                                  <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">Moderate</p>
                                                  <p class="text-[11px] text-slate-500 dark:text-slate-400">16–30 mins late</p>
                                             </div>
                                        </div>
                                        <p class="text-lg font-bold tabular-nums text-amber-600 dark:text-amber-400">{{ $tardiness['moderate'] }}×</p>
                                   </div>
                                   <div class="mt-3 border-t border-amber-100 pt-3 text-xs text-slate-500 dark:border-amber-900/50 dark:text-slate-400">
                                        <span class="font-semibold text-amber-700 dark:text-amber-300">{{ $tardiness['moderate_pct'] }}%</span> of late records
                                   </div>
                              </div>

                              {{-- Severe --}}
                              <div class="rounded-2xl border border-rose-100 bg-rose-50/50 p-4 dark:border-rose-900/50 dark:bg-rose-950/20">
                                   <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-2">
                                             <span class="h-2.5 w-2.5 rounded-full bg-rose-500"></span>
                                             <div>
                                                  <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">Severe</p>
                                                  <p class="text-[11px] text-slate-500 dark:text-slate-400">30+ mins late</p>
                                             </div>
                                        </div>
                                        <p class="text-lg font-bold tabular-nums text-rose-600 dark:text-rose-400">{{ $tardiness['severe'] }}×</p>
                                   </div>
                                   <div class="mt-3 border-t border-rose-100 pt-3 text-xs text-slate-500 dark:border-rose-900/50 dark:text-slate-400">
                                        <span class="font-semibold text-rose-700 dark:text-rose-300">{{ $tardiness['severe_pct'] }}%</span> of late records
                                   </div>
                              </div>
                         </div>

                         <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
                              <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800/70">
                                   <span class="text-xs text-slate-500 dark:text-slate-400">Avg. late per batch</span>
                                   <span class="text-xs font-semibold text-slate-800 dark:text-slate-200">{{ $tardiness['total_batches'] > 0 ? round($tardiness['total_late'] / $tardiness['total_batches'], 1) : 0 }}× per period</span>
                              </div>
                              <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800/70">
                                   <span class="text-xs text-slate-500 dark:text-slate-400">Worst severity level</span>
                                   @if($tardiness['severe'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-rose-200 bg-rose-50 px-2 py-0.5 text-[11px] font-semibold text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300"><span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Severe</span>
                                   @elseif($tardiness['moderate'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-amber-200 bg-amber-50 px-2 py-0.5 text-[11px] font-semibold text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Moderate</span>
                                   @elseif($tardiness['minor'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2 py-0.5 text-[11px] font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Minor</span>
                                   @endif
                              </div>
                         </div>
                    </div>
                    @else
                    <div class="flex flex-col items-center justify-center px-5 py-12 text-center">
                         <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-500 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                              <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                         </div>
                         <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">No Tardiness Recorded</p>
                         <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">All arrivals were on time across all batches.</p>
                    </div>
                    @endif
               </div>

          </div>

          {{-- Absence Breakdown --}}
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
               <div class="flex flex-col gap-3 border-b border-slate-100 bg-slate-50/80 px-5 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-slate-800 dark:bg-slate-800/60">
                    <div class="flex items-center gap-3">
                         <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300">
                              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                         </div>
                         <div>
                              <p class="text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Absence Detail</p>
                              <p class="mt-0.5 text-[11px] text-slate-400 dark:text-slate-500">Scheduled days, absences, and overall status</p>
                         </div>
                    </div>
                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold shadow-sm dark:border-slate-700 dark:bg-slate-900 {{ $absenceStatusColor }}">
                         <span class="h-1.5 w-1.5 rounded-full {{ $absences['absent_pct'] >= 20 ? 'bg-rose-500' : ($absences['absent_pct'] >= 10 ? 'bg-amber-500' : 'bg-emerald-500') }}"></span>
                         {{ $absenceStatus }}
                    </span>
               </div>

               @if($absences['total_absent'] > 0)
               <div class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0 xl:grid-cols-4 dark:divide-slate-800">

                    <div class="p-5">
                         <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Total Absent</p>
                         <p class="mt-2 text-4xl font-bold tabular-nums text-rose-600 dark:text-rose-400">{{ $absences['total_absent'] }}</p>
                         <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">days absent / AWOL</p>
                    </div>

                    <div class="p-5">
                         <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Scheduled Days</p>
                         <p class="mt-2 text-4xl font-bold tabular-nums text-slate-900 dark:text-white">{{ $absences['total_days'] }}</p>
                         <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">total across all batches</p>
                    </div>

                    <div class="p-5">
                         <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Absence Rate</p>
                         <p class="mt-2 text-4xl font-bold tabular-nums {{ $absences['absent_pct'] >= 20 ? 'text-rose-600 dark:text-rose-400' : ($absences['absent_pct'] >= 10 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400') }}">{{ $absences['absent_pct'] }}%</p>
                         <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">of scheduled days</p>
                    </div>

                    <div class="p-5">
                         <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">Days Present</p>
                         <p class="mt-2 text-4xl font-bold tabular-nums text-emerald-600 dark:text-emerald-400">{{ $absences['total_days'] - $absences['total_absent'] }}</p>
                         <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ 100 - $absences['absent_pct'] }}% attendance rate</p>
                    </div>

               </div>

               <div class="border-t border-slate-100 px-5 py-4 dark:border-slate-800">
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                         <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800/70">
                              <span class="text-xs text-slate-500 dark:text-slate-400">Avg. absent / batch</span>
                              <span class="text-sm font-bold text-rose-600 dark:text-rose-400">{{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}×</span>
                         </div>
                         <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800/70">
                              <span class="text-xs text-slate-500 dark:text-slate-400">No log recorded</span>
                              <span class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $absences['total_absent'] }} day(s)</span>
                         </div>
                         <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-800/70">
                              <span class="text-xs text-slate-500 dark:text-slate-400">Overall status</span>
                              <span class="text-sm font-bold {{ $absenceStatusColor }}">{{ $absenceStatus }}</span>
                         </div>
                    </div>
               </div>

               @else
               <div class="flex flex-col items-center justify-center px-5 py-12 text-center">
                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-500 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                         <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Perfect Attendance</p>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">No absences recorded across all batches.</p>
               </div>
               @endif
          </div>

     </div>
     @endif
</x-layouts.app.flowbite>