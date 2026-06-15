<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25M3 18.75A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75M3 18.75V10.5h18v8.25" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Training Schedule Items
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage and monitor all training schedule items.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    {{-- Total Badge --}}
                    <div class="inline-flex w-fit items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        Total Items
                        <span class="ml-2 rounded-lg bg-slate-100 px-2 py-1 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                            {{ method_exists($scheduleItems, 'total') ? $scheduleItems->total() : count($scheduleItems) }}
                        </span>
                    </div>

                    {{-- Search --}}
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 sm:w-72"
                            placeholder="Search schedule item...">

                        @if(!empty($search))
                        <button
                            type="button"
                            wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 transition hover:text-slate-600 dark:hover:text-slate-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707A1 1 0 116.707 5.293L10 8.586z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        @endif
                    </div>

                    {{-- Create Button --}}
                    <a href="{{ route('training_schedule_items.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        New Schedule Item
                    </a>
                </div>
            </div>
        </div>

        {{-- Livewire Loading Bar --}}
        <div wire:loading wire:target="search" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-indigo-500"></div>
        </div>

        {{-- ===== ALERTS ===== --}}
        @if(session()->has('success'))
        <div class="m-5 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-950/30 dark:text-emerald-300">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm dark:bg-slate-900 dark:text-emerald-300">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold">Success</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="m-5 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 shadow-sm dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-300">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm dark:bg-slate-900 dark:text-rose-300">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold">Error</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto border-t border-slate-100 dark:border-slate-800">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Name</th>
                        <th class="px-5 py-3 font-semibold">Description</th>
                        <th class="px-5 py-3 font-semibold">Schedule Days</th>
                        <th class="px-5 py-3 font-semibold">Time</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse ($scheduleItems as $scheduleItem)
                    <tr wire:key="schedule-item-{{ $scheduleItem->uuid }}" class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

                        {{-- Number --}}
                        <td class="px-5 py-4 align-top text-sm font-medium text-slate-400 dark:text-slate-500">
                            {{ $loop->iteration + ($scheduleItems->currentPage() - 1) * $scheduleItems->perPage() }}
                        </td>

                        {{-- Name --}}
                        <th scope="row" class="px-5 py-4 align-top">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50 dark:border-indigo-900/50 dark:bg-indigo-950/40">
                                    <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                        {{ strtoupper(substr($scheduleItem->name ?? 'S', 0, 1)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">
                                        {{ $scheduleItem->name }}
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                        Schedule Item
                                    </p>
                                </div>
                            </div>
                        </th>

                        {{-- Description --}}
                        <td class="max-w-xs px-5 py-4 align-top">
                            @if(!empty($scheduleItem->description))
                            <p class="line-clamp-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                                {{ $scheduleItem->description }}
                            </p>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-500">
                                No description
                            </span>
                            @endif
                        </td>

                        {{-- Schedule Days --}}
                        <td class="px-5 py-4 align-top">
                            @if(!empty($scheduleItem->schedule_days))
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($scheduleItem->schedule_days ?? [] as $day)
                                @php
                                $short = strtoupper(substr($day, 0, 3));
                                @endphp
                                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-700 dark:border-indigo-900/50 dark:bg-indigo-950/30 dark:text-indigo-300">
                                    {{ $short }}
                                </span>
                                @endforeach
                            </div>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-500">
                                No days
                            </span>
                            @endif
                        </td>

                        {{-- Time --}}
                        <td class="px-5 py-4 align-top whitespace-nowrap">
                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2" />
                                    <path stroke-linecap="round" stroke-width="2" d="M12 6v6l4 2" />
                                </svg>
                                {{ date('g:i A', strtotime($scheduleItem->start_time)) }}
                                <span class="text-emerald-300 dark:text-emerald-700">–</span>
                                {{ date('g:i A', strtotime($scheduleItem->end_time)) }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td class="px-5 py-4 text-right align-top">
                            <a href="{{ route('training_schedule_items.show', $scheduleItem->uuid) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                View
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No schedule item found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your search or create a new schedule item.
                                    </p>
                                </div>

                                <a href="{{ route('training_schedule_items.create') }}"
                                    class="mt-2 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Schedule Item
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($scheduleItems->hasPages())
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-xs text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $scheduleItems->firstItem() }}</span>
                –
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $scheduleItems->lastItem() }}</span>
                of
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $scheduleItems->total() }}</span>
                schedule items
            </div>

            <div>
                {{ $scheduleItems->links() }}
            </div>
        </div>
        @endif
    </div>
</div>