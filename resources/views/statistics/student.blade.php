<x-layouts.app.flowbite>
     @if(!empty($tardiness))
     <div class="space-y-3">

          {{-- Header --}}
          <div class="flex items-center justify-between">
               <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">Tardiness & Absences Summary</h2>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">Aggregated across all payroll batches</p>
               </div>
               <div>
                    @if($tardiness['severe'] > 0)
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-100 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                         <span class="inline-block h-1.5 w-1.5 rounded-full bg-rose-400"></span>
                         High Risk
                    </span>
                    @elseif($tardiness['moderate'] > 0)
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                         <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                         Moderate Risk
                    </span>
                    @elseif($tardiness['minor'] > 0)
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300">
                         <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                         Low Risk
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-semibold text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                         <span class="inline-block h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                         No Issues
                    </span>
                    @endif
               </div>
          </div>

          {{-- Top KPI Row --}}
          <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
               <div class="grid grid-cols-2 divide-x divide-y divide-gray-100 md:grid-cols-4 md:divide-y-0 dark:divide-gray-800">

                    {{-- Total Batches --}}
                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Batches</p>
                         <p class="text-4xl font-bold tabular-nums text-gray-800 dark:text-gray-100">{{ $tardiness['total_batches'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">payroll periods</p>
                         <div class="mt-3 space-y-1 border-t border-gray-100 pt-3 dark:border-gray-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Avg. late / batch</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $tardiness['total_batches'] > 0 ? round($tardiness['total_late'] / $tardiness['total_batches'], 1) : 0 }}×
                                   </span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Avg. absent / batch</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}×
                                   </span>
                              </div>
                         </div>
                    </div>

                    {{-- Late Arrivals --}}
                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Late Arrivals</p>
                         <p class="text-4xl font-bold tabular-nums text-amber-500 dark:text-amber-400">{{ $tardiness['total_late'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">instances across all batches</p>
                         <div class="mt-3 space-y-1 border-t border-gray-100 pt-3 dark:border-gray-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="flex items-center gap-1.5 text-gray-400 dark:text-gray-500">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                        Minor (1–15 min)
                                   </span>
                                   <span class="font-semibold text-green-600 dark:text-green-400">{{ $tardiness['minor'] }}×</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="flex items-center gap-1.5 text-gray-400 dark:text-gray-500">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                        Moderate (16–30 min)
                                   </span>
                                   <span class="font-semibold text-amber-600 dark:text-amber-400">{{ $tardiness['moderate'] }}×</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="flex items-center gap-1.5 text-gray-400 dark:text-gray-500">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-rose-400"></span>
                                        Severe (30+ min)
                                   </span>
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $tardiness['severe'] }}×</span>
                              </div>
                         </div>
                    </div>

                    {{-- Avg Minutes Late --}}
                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Avg. Minutes Late</p>
                         <div class="flex items-baseline gap-1">
                              <p class="text-4xl font-bold tabular-nums text-orange-500 dark:text-orange-400">{{ $tardiness['avg_minutes'] }}</p>
                              <span class="text-sm font-medium text-orange-400 dark:text-orange-300">min</span>
                         </div>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">per late instance</p>
                         <div class="mt-3 space-y-1 border-t border-gray-100 pt-3 dark:border-gray-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Worst severity</span>
                                   @if($tardiness['severe'] > 0)
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">Severe</span>
                                   @elseif($tardiness['moderate'] > 0)
                                   <span class="font-semibold text-amber-600 dark:text-amber-400">Moderate</span>
                                   @elseif($tardiness['minor'] > 0)
                                   <span class="font-semibold text-green-600 dark:text-green-400">Minor</span>
                                   @else
                                   <span class="font-semibold text-gray-500">None</span>
                                   @endif
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Minor share</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $tardiness['minor_pct'] }}%</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Severe share</span>
                                   <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $tardiness['severe_pct'] }}%</span>
                              </div>
                         </div>
                    </div>

                    {{-- Total Absences --}}
                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Absences</p>
                         <div class="flex items-baseline gap-1">
                              <p class="text-4xl font-bold tabular-nums text-rose-400 dark:text-rose-300">{{ $absences['total_absent'] }}</p>
                              <span class="text-sm font-medium text-gray-400 dark:text-gray-500">/ {{ $absences['total_days'] }} days</span>
                         </div>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">scheduled days across all batches</p>
                         <div class="mt-3 space-y-1 border-t border-gray-100 pt-3 dark:border-gray-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Absence rate</span>
                                   <span class="font-semibold {{ $absences['absent_pct'] >= 20 ? 'text-rose-600 dark:text-rose-400' : ($absences['absent_pct'] >= 10 ? 'text-amber-600 dark:text-amber-400' : 'text-green-600 dark:text-green-400') }}">
                                        {{ $absences['absent_pct'] }}%
                                   </span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Attendance rate</span>
                                   @php $attRate = 100 - $absences['absent_pct']; @endphp
                                   <span class="font-semibold {{ $attRate >= 90 ? 'text-green-600 dark:text-green-400' : ($attRate >= 75 ? 'text-amber-600 dark:text-amber-400' : 'text-rose-600 dark:text-rose-400') }}">
                                        {{ $attRate }}%
                                   </span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Days present</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $absences['total_days'] - $absences['total_absent'] }}</span>
                              </div>
                         </div>
                    </div>

               </div>
          </div>

          {{-- Second Row: Attendance Health + Tardiness Breakdown --}}
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">

               {{-- Attendance Health --}}
               <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-5 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                         <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10">
                              <svg class="h-3.5 w-3.5 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                         </div>
                         <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Attendance Health</p>
                    </div>
                    <div class="p-5">
                         @php
                         $attendancePct = $absences['total_days'] > 0
                         ? round((($absences['total_days'] - $absences['total_absent']) / $absences['total_days']) * 100, 1)
                         : 100;
                         $healthColor = $attendancePct >= 90 ? 'text-green-500 dark:text-green-400' : ($attendancePct >= 75 ? 'text-amber-500 dark:text-amber-400' : 'text-rose-400 dark:text-rose-300');
                         $healthLabel = $attendancePct >= 90 ? 'Excellent' : ($attendancePct >= 75 ? 'Fair' : 'Poor');
                         $healthBadge = $attendancePct >= 90
                         ? 'border-green-200 bg-green-50 text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300'
                         : ($attendancePct >= 75
                         ? 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300'
                         : 'border-rose-100 bg-rose-50 text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300');
                         @endphp

                         <div class="mb-4 flex items-end justify-between">
                              <div>
                                   <p class="text-5xl font-bold tabular-nums {{ $healthColor }}">{{ $attendancePct }}%</p>
                                   <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">attendance rate</p>
                              </div>
                              <span class="rounded-xl border px-3 py-1.5 text-sm font-bold {{ $healthBadge }}">
                                   {{ $healthLabel }}
                              </span>
                         </div>

                         <div class="space-y-2 border-t border-gray-100 pt-4 dark:border-gray-800">
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Days present</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $absences['total_days'] - $absences['total_absent'] }} of {{ $absences['total_days'] }}</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Days absent / AWOL</span>
                                   <span class="font-semibold text-rose-500 dark:text-rose-400">{{ $absences['total_absent'] }}</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Absence rate</span>
                                   <span class="font-semibold {{ $absences['absent_pct'] >= 20 ? 'text-rose-500 dark:text-rose-400' : ($absences['absent_pct'] >= 10 ? 'text-amber-500 dark:text-amber-400' : 'text-green-500 dark:text-green-400') }}">
                                        {{ $absences['absent_pct'] }}%
                                   </span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Total payroll batches</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $tardiness['total_batches'] }}</span>
                              </div>
                              <div class="flex items-center justify-between text-xs">
                                   <span class="text-gray-400 dark:text-gray-500">Avg. absences per batch</span>
                                   <span class="font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}
                                   </span>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Tardiness Severity Breakdown --}}
               <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-5 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                         <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-500/10">
                              <svg class="h-3.5 w-3.5 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                              </svg>
                         </div>
                         <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tardiness Breakdown</p>
                    </div>

                    @if($tardiness['total_late'] > 0)
                    <div class="p-5">

                         <div class="mb-4 flex items-end justify-between">
                              <div>
                                   <p class="text-5xl font-bold tabular-nums text-amber-500 dark:text-amber-400">{{ $tardiness['total_late'] }}</p>
                                   <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">total late instances</p>
                              </div>
                              <div class="text-right">
                                   <p class="text-2xl font-bold tabular-nums text-orange-500 dark:text-orange-400">{{ $tardiness['avg_minutes'] }}<span class="text-sm font-normal text-gray-400"> min</span></p>
                                   <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">avg. per instance</p>
                              </div>
                         </div>

                         <div class="space-y-3 border-t border-gray-100 pt-4 dark:border-gray-800">
                              {{-- Minor --}}
                              <div class="flex items-center justify-between">
                                   <div class="flex items-center gap-2">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-400"></span>
                                        <div>
                                             <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Minor</p>
                                             <p class="text-[10px] text-gray-400 dark:text-gray-500">1–15 mins late</p>
                                        </div>
                                   </div>
                                   <div class="text-right">
                                        <p class="text-sm font-bold tabular-nums text-green-600 dark:text-green-400">{{ $tardiness['minor'] }}×</p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $tardiness['minor_pct'] }}% of late</p>
                                   </div>
                              </div>
                              {{-- Moderate --}}
                              <div class="flex items-center justify-between">
                                   <div class="flex items-center gap-2">
                                        <span class="inline-block h-2 w-2 rounded-full bg-amber-400"></span>
                                        <div>
                                             <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Moderate</p>
                                             <p class="text-[10px] text-gray-400 dark:text-gray-500">16–30 mins late</p>
                                        </div>
                                   </div>
                                   <div class="text-right">
                                        <p class="text-sm font-bold tabular-nums text-amber-600 dark:text-amber-400">{{ $tardiness['moderate'] }}×</p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $tardiness['moderate_pct'] }}% of late</p>
                                   </div>
                              </div>
                              {{-- Severe --}}
                              <div class="flex items-center justify-between">
                                   <div class="flex items-center gap-2">
                                        <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span>
                                        <div>
                                             <p class="text-xs font-semibold text-gray-700 dark:text-gray-200">Severe</p>
                                             <p class="text-[10px] text-gray-400 dark:text-gray-500">30+ mins late</p>
                                        </div>
                                   </div>
                                   <div class="text-right">
                                        <p class="text-sm font-bold tabular-nums text-rose-600 dark:text-rose-400">{{ $tardiness['severe'] }}×</p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $tardiness['severe_pct'] }}% of late</p>
                                   </div>
                              </div>

                              {{-- Batch average --}}
                              <div class="flex items-center justify-between border-t border-gray-100 pt-3 dark:border-gray-800">
                                   <span class="text-xs text-gray-400 dark:text-gray-500">Avg. late per batch</span>
                                   <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $tardiness['total_batches'] > 0 ? round($tardiness['total_late'] / $tardiness['total_batches'], 1) : 0 }}× per period
                                   </span>
                              </div>
                              <div class="flex items-center justify-between">
                                   <span class="text-xs text-gray-400 dark:text-gray-500">Worst severity level</span>
                                   @if($tardiness['severe'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-rose-100 bg-rose-50 px-2 py-0.5 text-[11px] font-semibold text-rose-600 dark:border-rose-900/20 dark:bg-rose-500/10 dark:text-rose-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-400"></span> Severe
                                   </span>
                                   @elseif($tardiness['moderate'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-amber-200 bg-amber-50 px-2 py-0.5 text-[11px] font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span> Moderate
                                   </span>
                                   @elseif($tardiness['minor'] > 0)
                                   <span class="inline-flex items-center gap-1 rounded-full border border-green-200 bg-green-50 px-2 py-0.5 text-[11px] font-semibold text-green-700 dark:border-green-900/40 dark:bg-green-500/10 dark:text-green-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span> Minor
                                   </span>
                                   @endif
                              </div>
                         </div>
                    </div>
                    @else
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                         <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 dark:bg-green-500/10">
                              <svg class="h-6 w-6 text-green-400 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                         </div>
                         <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">No Tardiness Recorded</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">All arrivals were on time across all batches.</p>
                    </div>
                    @endif
               </div>

          </div>

          {{-- Absence Breakdown --}}
          <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
               <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50 px-5 py-3.5 dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-50 dark:bg-rose-500/10">
                         <svg class="h-3.5 w-3.5 text-rose-400 dark:text-rose-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                         </svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Absence Detail</p>
               </div>

               @if($absences['total_absent'] > 0)
               <div class="grid grid-cols-2 divide-x divide-gray-100 dark:divide-gray-800 md:grid-cols-4">

                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total Absent</p>
                         <p class="text-4xl font-bold tabular-nums text-rose-400 dark:text-rose-300">{{ $absences['total_absent'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">days absent / AWOL</p>
                    </div>

                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Scheduled Days</p>
                         <p class="text-4xl font-bold tabular-nums text-gray-700 dark:text-gray-200">{{ $absences['total_days'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">total across all batches</p>
                    </div>

                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Absence Rate</p>
                         <p class="text-4xl font-bold tabular-nums {{ $absences['absent_pct'] >= 20 ? 'text-rose-400 dark:text-rose-300' : ($absences['absent_pct'] >= 10 ? 'text-amber-500 dark:text-amber-400' : 'text-green-500 dark:text-green-400') }}">
                              {{ $absences['absent_pct'] }}%
                         </p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">of scheduled days</p>
                    </div>

                    <div class="p-5">
                         <p class="mb-1 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Days Present</p>
                         <p class="text-4xl font-bold tabular-nums text-green-500 dark:text-green-400">{{ $absences['total_days'] - $absences['total_absent'] }}</p>
                         <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ 100 - $absences['absent_pct'] }}% attendance rate</p>
                    </div>

               </div>

               <div class="border-t border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                         <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-2.5 dark:bg-gray-800/50">
                              <span class="text-xs text-gray-400 dark:text-gray-500">Avg. absent / batch</span>
                              <span class="text-sm font-bold text-rose-500 dark:text-rose-400">
                                   {{ $tardiness['total_batches'] > 0 ? round($absences['total_absent'] / $tardiness['total_batches'], 1) : 0 }}×
                              </span>
                         </div>
                         <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-2.5 dark:bg-gray-800/50">
                              <span class="text-xs text-gray-400 dark:text-gray-500">No log recorded</span>
                              <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ $absences['total_absent'] }} day(s)</span>
                         </div>
                         <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-2.5 dark:bg-gray-800/50">
                              <span class="text-xs text-gray-400 dark:text-gray-500">Overall status</span>
                              @if($absences['absent_pct'] >= 20)
                              <span class="text-sm font-bold text-rose-500 dark:text-rose-400">Critical</span>
                              @elseif($absences['absent_pct'] >= 10)
                              <span class="text-sm font-bold text-amber-500 dark:text-amber-400">Needs Attention</span>
                              @else
                              <span class="text-sm font-bold text-green-500 dark:text-green-400">Acceptable</span>
                              @endif
                         </div>
                    </div>
               </div>

               @else
               <div class="flex flex-col items-center justify-center py-10 text-center">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 dark:bg-green-500/10">
                         <svg class="h-6 w-6 text-green-400 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Perfect Attendance</p>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">No absences recorded across all batches.</p>
               </div>
               @endif
          </div>

     </div>
     @endif
</x-layouts.app.flowbite>