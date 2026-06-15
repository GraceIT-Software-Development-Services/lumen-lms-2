<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0A50.57 50.57 0 0112 3.493a50.57 50.57 0 017.74 6.654M12 13.489a50.697 50.697 0 00-7.74-3.342m15.48 0A50.702 50.702 0 0012 13.489" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Training Batches
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage training batches, trainers, participants, and schedules.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('training_batches.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Training Batch
                    </a>

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
                            placeholder="Search batch...">

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
                </div>
            </div>
        </div>

        {{-- Livewire Loading Bar --}}
        <div wire:loading wire:target="search" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-indigo-500"></div>
        </div>

        {{-- Alerts --}}
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

        {{-- ===== SUMMARY CARDS ===== --}}
        <div class="grid grid-cols-2 gap-3 px-5 py-5 sm:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Total</p>
                <p class="mt-1 text-2xl font-bold text-slate-950 dark:text-white">{{ $trainingBatches->total() }}</p>
            </div>

            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">Open</p>
                <p class="mt-1 text-2xl font-bold text-emerald-700 dark:text-emerald-300">
                    {{ $trainingBatches->where('status', 'open')->count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4 dark:border-blue-900/50 dark:bg-blue-950/30">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-700 dark:text-blue-300">Ongoing</p>
                <p class="mt-1 text-2xl font-bold text-blue-700 dark:text-blue-300">
                    {{ $trainingBatches->where('status', 'ongoing')->count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Completed</p>
                <p class="mt-1 text-2xl font-bold text-slate-800 dark:text-slate-100">
                    {{ $trainingBatches->where('status', 'completed')->count() }}
                </p>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto border-t border-slate-100 dark:border-slate-800">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Batch</th>
                        <th class="px-5 py-3 font-semibold">Course</th>
                        <th class="px-5 py-3 font-semibold">Schedule</th>
                        <th class="px-5 py-3 font-semibold">Participants</th>
                        <th class="px-5 py-3 font-semibold">Trainer</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse ($trainingBatches as $trainingBatch)
                    <tr wire:key="training-batch-{{ $trainingBatch->uuid }}" class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

                        <td class="px-5 py-4 text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ $loop->iteration + ($trainingBatches->currentPage() - 1) * $trainingBatches->perPage() }}
                        </td>

                        <th scope="row" class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50 dark:border-indigo-900/50 dark:bg-indigo-950/40">
                                    <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                        {{ strtoupper(substr($trainingBatch->batch_name, 0, 1)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-xs font-bold uppercase tracking-wide text-slate-900 dark:text-white">
                                        {{ $trainingBatch->batch_name }}
                                    </p>
                                    <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                        {{ $trainingBatch->batch_code }}
                                    </p>
                                </div>
                            </div>
                        </th>

                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-100">
                                    {{ $trainingBatch->course_name }}
                                </p>
                                <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                    {{ $trainingBatch->course_code }}
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-600 dark:text-slate-300">
                                <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ date('M d, Y', strtotime($trainingBatch->start_date)) }}
                                <span class="text-slate-300 dark:text-slate-600">–</span>
                                {{ date('M d, Y', strtotime($trainingBatch->end_date)) }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            @php
                            $pct = $trainingBatch->max_participants > 0
                            ? round(($trainingBatch->registered_students_count / $trainingBatch->max_participants) * 100)
                            : 0;

                            $barColor = $pct >= 100
                            ? 'bg-amber-500'
                            : ($pct >= 75 ? 'bg-blue-500' : 'bg-emerald-500');
                            @endphp

                            <div class="w-32">
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                        {{ $trainingBatch->registered_students_count }} / {{ $trainingBatch->max_participants }}
                                    </span>
                                    <span class="text-[10px] font-medium text-slate-400">
                                        {{ min($pct, 100) }}%
                                    </span>
                                </div>

                                <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                                    <div class="h-full rounded-full {{ $barColor }}" style="width: {{ min($pct, 100) }}%"></div>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            @if($trainingBatch->trainer_name)
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-emerald-100 bg-emerald-50 dark:border-emerald-900/50 dark:bg-emerald-950/40">
                                    <span class="text-xs font-bold text-emerald-700 dark:text-emerald-300">
                                        {{ strtoupper(substr($trainingBatch->trainer_name, 0, 1)) }}{{ strtoupper(substr($trainingBatch->trainer_last_name ?? '', 0, 1)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="whitespace-nowrap text-xs font-semibold text-slate-900 dark:text-white">
                                        {{ $trainingBatch->trainer_name }} {{ $trainingBatch->trainer_last_name }}
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                        {{ $trainingBatch->center_name }}
                                    </p>
                                </div>
                            </div>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                Not assigned
                            </span>
                            @endif
                        </td>

                        <td class="px-5 py-4">
                            @php
                            $statusColors = [
                            'open' => 'border-emerald-100 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300',
                            'ongoing' => 'border-blue-100 bg-blue-50 text-blue-700 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300',
                            'full' => 'border-amber-100 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300',
                            'completed' => 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300',
                            'cancelled' => 'border-rose-100 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300',
                            ];
                            @endphp

                            <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusColors[$trainingBatch->status] ?? 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300' }}">
                                <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ ucfirst($trainingBatch->status) }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('training_batches.show', $trainingBatch->uuid) }}"
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
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No training batches found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your search or create a new batch.
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($trainingBatches->hasPages())
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-xs text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->firstItem() }}</span>
                –
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->lastItem() }}</span>
                of
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->total() }}</span>
                batches
            </div>

            <div>
                {{ $trainingBatches->links() }}
            </div>
        </div>
        @endif
    </div>
</div>