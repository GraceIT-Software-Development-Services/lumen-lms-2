<div>
    {{-- ═══════════════════════════════════════════════════════════
         Learner Dashboard Cards
         resources/views/livewire/dashboard/learner/card-livewire.blade.php
    ═══════════════════════════════════════════════════════════ --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-4">

        {{-- ① Active Course ────────────────────────────────────────────── --}}
        <div class="col-span-1 sm:col-span-2 xl:col-span-2">
            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm
                        transition-all duration-200 hover:shadow-md hover:-translate-y-0.5
                        dark:border-gray-800 dark:bg-gray-900 min-h-36">

                {{-- Loading skeleton --}}
                <div wire:loading wire:target="render"
                    class="absolute inset-0 z-10 flex items-start gap-4 rounded-2xl bg-white p-5 dark:bg-gray-900">
                    <div class="h-10 w-10 animate-pulse rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="flex-1 space-y-2 pt-1">
                        <div class="h-3 w-32 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                        <div class="h-5 w-48 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                        <div class="h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                </div>

                {{-- Content --}}
                <div wire:loading.remove wire:target="render">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl
                                    bg-blue-50 dark:bg-blue-500/10">
                            <svg class="h-5 w-5 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Active Course</p>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500">Currently enrolled</p>
                        </div>
                    </div>

                    @if($activeCourse)
                    <p class="text-xl font-bold leading-tight text-gray-800 dark:text-gray-100">
                        {{ $activeCourse->course_name }}
                    </p>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        {{-- Course code --}}
                        <span class="inline-flex items-center rounded-lg border border-blue-100 bg-blue-50 px-2 py-0.5
                                         text-[11px] font-semibold text-blue-600
                                         dark:border-blue-900/30 dark:bg-blue-500/10 dark:text-blue-300">
                            {{ $activeCourse->course_code }}
                        </span>

                        {{-- Batch name --}}
                        @if(!empty($activeCourse->batch_name))
                        <span class="inline-flex items-center gap-1 text-[11px] text-gray-400 dark:text-gray-500">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $activeCourse->batch_name }}
                        </span>
                        @endif

                        {{-- Status badge --}}
                        @php
                        $statusMap = [
                        'ongoing' => ['text' => 'Ongoing', 'classes' => 'border-green-200 bg-green-50 text-green-700 dark:border-green-900/30 dark:bg-green-500/10 dark:text-green-300'],
                        'open' => ['text' => 'Open', 'classes' => 'border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-900/30 dark:bg-sky-500/10 dark:text-sky-300'],
                        'full' => ['text' => 'Full', 'classes' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/30 dark:bg-amber-500/10 dark:text-amber-300'],
                        ];
                        $s = $statusMap[$activeCourse->batch_status] ?? ['text' => ucfirst($activeCourse->batch_status), 'classes' => 'border-gray-200 bg-gray-50 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400'];
                        @endphp
                        <span class="inline-flex items-center gap-1 rounded-lg border px-2 py-0.5 text-[11px] font-semibold {{ $s['classes'] }}">
                            <span class="inline-block h-1.5 w-1.5 rounded-full
                                    {{ $activeCourse->batch_status === 'ongoing' ? 'bg-green-400 animate-pulse' : ($activeCourse->batch_status === 'open' ? 'bg-sky-400' : 'bg-amber-400') }}"></span>
                            {{ $s['text'] }}
                        </span>
                    </div>

                    {{-- Date range --}}
                    @if(!empty($activeCourse->start_date))
                    <div class="mt-3 flex items-center gap-1.5 text-[11px] text-gray-400 dark:text-gray-500">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($activeCourse->start_date)->format('M d, Y') }}
                        @if(!empty($activeCourse->end_date))
                        — {{ \Carbon\Carbon::parse($activeCourse->end_date)->format('M d, Y') }}
                        @endif
                    </div>
                    @endif

                    @else
                    <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">No active course enrolled.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- ② Active Batches ───────────────────────────────────────────── --}}
        <div class="col-span-2">
            <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm
                        transition-all duration-200 hover:shadow-md hover:-translate-y-0.5
                        dark:border-gray-800 dark:bg-gray-900 min-h-36">

                <div wire:loading wire:target="render"
                    class="absolute inset-0 z-10 flex flex-col gap-3 rounded-2xl bg-white p-5 dark:bg-gray-900">
                    <div class="h-10 w-10 animate-pulse rounded-xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>

                <div wire:loading.remove wire:target="render">
                    <div class="mb-4 flex items-center justify-between">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-500/10">
                            <svg class="h-5 w-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                            </svg>
                        </div>
                    </div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Active Batches</p>
                    <p class="mt-1 text-4xl font-bold tabular-nums text-indigo-500 dark:text-indigo-400">{{ $activeBatch }}</p>
                    <p class="mt-1 text-[11px] text-gray-400 dark:text-gray-500">Currently enrolled batches</p>

                    <div class="mt-3 space-y-1 border-t border-gray-100 pt-3 dark:border-gray-800">
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-gray-400 dark:text-gray-500">Total history</span>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $batchHistory }} batches</span>
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <span class="text-gray-400 dark:text-gray-500">Completed</span>
                            <span class="font-semibold text-green-600 dark:text-green-400">{{ $completedCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Upcoming Batch Banner (shown only when a pending batch exists) ──── --}}
    @if($upcomingBatch)
    <div class="mb-4 flex items-center gap-3 rounded-2xl border border-sky-100 bg-sky-50 px-5 py-3.5
                dark:border-sky-900/20 dark:bg-sky-500/5">
        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-xl bg-sky-100 dark:bg-sky-500/10">
            <svg class="h-4 w-4 text-sky-500 dark:text-sky-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold text-sky-700 dark:text-sky-300">Upcoming Batch</p>
            <p class="truncate text-sm font-medium text-sky-800 dark:text-sky-200">
                {{ $upcomingBatch->course_name }}
                @if(!empty($upcomingBatch->batch_name))
                <span class="font-normal text-sky-600 dark:text-sky-400">· {{ $upcomingBatch->batch_name }}</span>
                @endif
            </p>
        </div>
        @if(!empty($upcomingBatch->start_date))
        <span class="flex-shrink-0 text-xs font-semibold text-sky-600 dark:text-sky-400">
            Starts {{ \Carbon\Carbon::parse($upcomingBatch->start_date)->format('M d, Y') }}
        </span>
        @endif
    </div>
    @endif

</div>