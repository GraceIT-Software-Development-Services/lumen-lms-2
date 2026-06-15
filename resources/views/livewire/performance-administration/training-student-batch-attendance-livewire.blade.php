<div class="space-y-6">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14.25c-3.728 0-6.75 2.239-6.75 5m13.5-5c3.728 0 6.75 2.239 6.75 5m-13.5 0h13.5M12 12a3.75 3.75 0 100-7.5A3.75 3.75 0 0012 12zm7.5-1.5a3 3 0 100-6 3 3 0 000 6zm-15 0a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Student Batch Attendances
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage, monitor, and generate attendance reports for training batches.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="inline-flex w-fit items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        Total Batches
                        <span class="ml-2 rounded-lg bg-slate-100 px-2 py-1 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                            {{ method_exists($trainingBatches, 'total') ? $trainingBatches->total() : count($trainingBatches) }}
                        </span>
                    </div>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search batch or schedule..."
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 sm:w-80">

                        @if(!empty($search))
                        <button
                            type="button"
                            wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 transition hover:text-slate-600 dark:hover:text-slate-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707A1 1 0 116.707 5.293L10 8.586z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Loading Bar --}}
        <div wire:loading wire:target="search" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-indigo-500"></div>
        </div>
    </div>

    {{-- ===== FLASH MESSAGES ===== --}}
    @if(session()->has('success'))
    <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-950/30 dark:text-emerald-300">
        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm dark:bg-slate-900 dark:text-emerald-300">
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
    <div class="flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 shadow-sm dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-300">
        <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm dark:bg-slate-900 dark:text-rose-300">
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

    {{-- ===== BATCH CARDS ===== --}}
    <div class="space-y-5">
        @forelse($trainingBatches as $trainingBatch)
        <div
            wire:key="training-batch-{{ $trainingBatch->uuid }}"
            class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg dark:border-slate-700 dark:bg-slate-900 dark:hover:border-indigo-900/60">

            {{-- Card Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-white to-slate-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:to-slate-800/70">
                <div class="flex flex-col gap-5 xl:flex-row xl:items-start xl:justify-between">

                    <div class="flex min-w-0 flex-1 items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 01112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" />
                            </svg>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="truncate text-lg font-semibold tracking-tight text-slate-950 dark:text-white">
                                    {{ $trainingBatch->batch_name }}
                                </h3>

                                <span class="inline-flex items-center rounded-full border border-blue-100 bg-blue-50 px-2.5 py-1 font-mono text-[11px] font-semibold text-blue-700 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                                    {{ $trainingBatch->batch_code }}
                                </span>
                            </div>

                            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-500 dark:text-slate-400">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }}
                                </span>

                                <span class="text-slate-300 dark:text-slate-600">—</span>

                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-2 xl:justify-end">

                        <button
                            type="button"
                            wire:click.prevent="completeTrainingBatch('{{ $trainingBatch->uuid }}')"
                            wire:confirm="Are you sure you want to mark this training batch as complete?"
                            wire:loading.attr="disabled"
                            wire:target="completeTrainingBatch('{{ $trainingBatch->uuid }}')"
                            class="inline-flex items-center gap-2 rounded-xl border border-rose-100 bg-rose-50 px-3.5 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-4 focus:ring-rose-500/10 disabled:cursor-not-allowed disabled:opacity-60 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300">
                            <svg wire:loading.remove wire:target="completeTrainingBatch('{{ $trainingBatch->uuid }}')" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-.723 3.066 3.745 3.745 0 01-3.066.723A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 01-3.066-.723 3.745 3.745 0 01-.723-3.066A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 01.723-3.066 3.745 3.745 0 013.066-.723A3.745 3.745 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 013.066.723 3.745 3.745 0 01.723 3.066A3.745 3.745 0 0121 12z" />
                            </svg>
                            <svg wire:loading wire:target="completeTrainingBatch('{{ $trainingBatch->uuid }}')" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Complete Batch
                        </button>

                        <a href="{{ route('training_student_batch_attendances.create', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-indigo-100 bg-indigo-50 px-3.5 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 dark:border-indigo-900/50 dark:bg-indigo-950/30 dark:text-indigo-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Attendance
                        </a>

                        <a href="{{ route('training_student_batch_attendances.report', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-3.5 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Attendance Report
                        </a>

                        <a href="{{ route('training_evaluation.index', ['uuid' => $trainingBatch->uuid]) }}"
                            wire:confirm="Are you sure you want to evaluate this training batch?"
                            class="inline-flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3.5 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            Training Evaluation
                        </a>
                    </div>
                </div>
            </div>

            {{-- Info Grid --}}
            <div class="grid gap-px bg-slate-100 dark:bg-slate-800 md:grid-cols-3">

                <div class="bg-white px-5 py-4 dark:bg-slate-900">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/40 dark:text-indigo-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.966 8.966 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">
                                Schedule Item
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-100">
                                {{ $trainingBatch->training_schedule_item_name }}
                            </p>
                            @if($trainingBatch->training_schedule_item_description)
                            <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                                {{ Str::limit($trainingBatch->training_schedule_item_description, 90) }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white px-5 py-4 dark:bg-slate-900">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-950/40 dark:text-teal-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">
                                Time
                            </p>
                            <div class="mt-1 flex items-center gap-2 text-sm font-semibold text-slate-800 dark:text-slate-100">
                                <span>{{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_start_time)->format('g:i A') }}</span>
                                <span class="text-slate-300 dark:text-slate-600">—</span>
                                <span>{{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_end_time)->format('g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white px-5 py-4 dark:bg-slate-900">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500">
                                Students
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-800 dark:text-slate-100">
                                {{ $trainingBatch->registered_students_count }}
                                <span class="font-normal text-slate-500 dark:text-slate-400">enrolled</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center dark:border-slate-700 dark:bg-slate-900">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h3 class="mt-4 text-sm font-semibold text-slate-700 dark:text-slate-200">
                No training batches found
            </h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Batches will appear here once created or when your search matches a record.
            </p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($trainingBatches, 'hasPages') && $trainingBatches->hasPages())
    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-xs text-slate-500 dark:text-slate-400">
            Showing
            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->firstItem() }}</span>
            to
            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->lastItem() }}</span>
            of
            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $trainingBatches->total() }}</span>
            batches
        </p>

        <div>
            {{ $trainingBatches->links() }}
        </div>
    </div>
    @endif
</div>