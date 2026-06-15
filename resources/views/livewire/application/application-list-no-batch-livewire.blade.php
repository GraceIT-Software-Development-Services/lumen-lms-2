<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2.25 4H6.75A2.25 2.25 0 014.5 17.75V6.25A2.25 2.25 0 016.75 4h6.879a2.25 2.25 0 011.591.659l3.621 3.621a2.25 2.25 0 01.659 1.591v7.879A2.25 2.25 0 0117.25 20z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Applications Without Assigned Batch
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Review pending applications without training batch and assign them in bulk.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <button
                        type="button"
                        wire:click.prevent="printReport()"
                        wire:loading.attr="disabled"
                        wire:target="printReport"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 disabled:cursor-not-allowed disabled:opacity-70 dark:bg-emerald-500 dark:hover:bg-emerald-600">

                        <svg wire:loading.remove wire:target="printReport" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18.5A2.25 2.25 0 008.58 21h6.84a2.25 2.25 0 002.24-2.5l-.38-4.671m0 0c.24.03.48.062.72.096m-11.28-.096V6.75A2.25 2.25 0 018.97 4.5h6.06a2.25 2.25 0 012.25 2.25v7.079" />
                        </svg>

                        <svg wire:loading wire:target="printReport" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="printReport">
                            Print Report
                        </span>
                        <span wire:loading wire:target="printReport">
                            Preparing...
                        </span>
                    </button>

                    <button
                        type="button"
                        wire:click.prevent="assignTrainingBatch()"
                        wire:loading.attr="disabled"
                        wire:target="assignTrainingBatch"
                        @disabled(count($selectedIds ?? [])===0)
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-indigo-500 dark:hover:bg-indigo-600">

                        <svg wire:loading.remove wire:target="assignTrainingBatch" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <svg wire:loading wire:target="assignTrainingBatch" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="assignTrainingBatch">
                            Assign Training Batch
                        </span>
                        <span wire:loading wire:target="assignTrainingBatch">
                            Loading...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Loading Bar --}}
        <div wire:loading wire:target="search,filterCenterId,filterTrainingCourseId,pageCount,printReport,assignTrainingBatch,confirmBatchAssignment,selectAll,selectedIds" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
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

        {{-- ===== SUMMARY CARDS ===== --}}
        @php
        $applicantRows = method_exists($applicants, 'getCollection') ? $applicants->getCollection() : collect($applicants);

        $totalApplications = method_exists($applicants, 'total') ? $applicants->total() : $applicantRows->count();
        $selectedCount = count($selectedIds ?? []);
        $pendingCount = $applicantRows->where('status', 'pending')->count();
        $approvedCount = $applicantRows->where('status', 'approved')->count();

        $hasFilters = !empty($search) || !empty($filterCenterId) || !empty($filterTrainingCourseId);
        @endphp

        <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Total Applications
                        </p>
                        <p class="mt-2 text-2xl font-bold text-slate-950 dark:text-white">
                            {{ number_format($totalApplications) }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Without assigned batch
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-slate-600 shadow-sm dark:bg-slate-900 dark:text-slate-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2.25 4H6.75A2.25 2.25 0 014.5 17.75V6.25A2.25 2.25 0 016.75 4h6.879a2.25 2.25 0 011.591.659l3.621 3.621a2.25 2.25 0 01.659 1.591v7.879A2.25 2.25 0 0117.25 20z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-indigo-200 bg-indigo-50 p-4 dark:border-indigo-900/50 dark:bg-indigo-950/30">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-indigo-700 dark:text-indigo-300">
                            Selected
                        </p>
                        <p class="mt-2 text-2xl font-bold text-indigo-800 dark:text-indigo-200">
                            {{ number_format($selectedCount) }}
                        </p>
                        <p class="mt-1 text-xs text-indigo-700/80 dark:text-indigo-300/80">
                            Ready for batch assignment
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm dark:bg-slate-900 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 dark:border-amber-900/50 dark:bg-amber-950/30">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-300">
                            Pending
                        </p>
                        <p class="mt-2 text-2xl font-bold text-amber-800 dark:text-amber-200">
                            {{ number_format($pendingCount) }}
                        </p>
                        <p class="mt-1 text-xs text-amber-700/80 dark:text-amber-300/80">
                            Visible in current page
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-amber-600 shadow-sm dark:bg-slate-900 dark:text-amber-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">
                            Approved
                        </p>
                        <p class="mt-2 text-2xl font-bold text-emerald-800 dark:text-emerald-200">
                            {{ number_format($approvedCount) }}
                        </p>
                        <p class="mt-1 text-xs text-emerald-700/80 dark:text-emerald-300/80">
                            Visible in current page
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm dark:bg-slate-900 dark:text-emerald-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FILTERS ===== --}}
        <div class="mx-5 mb-5 rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900 dark:text-white">
                        Filter Applications
                    </h2>
                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                        Center, training course, and search filters also apply when printing the report.
                    </p>
                </div>

                @if($hasFilters)
                <button
                    type="button"
                    wire:click="resetFilters"
                    class="inline-flex w-fit items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Clear Filters
                </button>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">

                {{-- Search --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Search
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search applicant, course, center..."
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500">
                    </div>
                </div>

                {{-- Training Course --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Training Course
                    </label>

                    <select
                        wire:model.live="filterTrainingCourseId"
                        class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                        <option value="">All Courses</option>

                        @foreach($trainingCourse as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->course_name }}{{ $course->course_code ? ' - ' . $course->course_code : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Center --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Training Center
                    </label>

                    <select
                        wire:model.live="filterCenterId"
                        class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                        <option value="">All Centers</option>

                        @foreach($centers as $center)
                        <option value="{{ $center->id }}">
                            {{ $center->name }}{{ $center->code ? ' - ' . $center->code : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Rows Per Page --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Rows Per Page
                    </label>

                    <select
                        wire:model.live="pageCount"
                        class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                        <option value="10">10 rows</option>
                        <option value="25">25 rows</option>
                        <option value="50">50 rows</option>
                        <option value="100">100 rows</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ===== SELECTION NOTICE ===== --}}
        @if($selectedCount > 0)
        <div class="mx-5 mb-5 flex flex-col gap-3 rounded-2xl border border-indigo-200 bg-indigo-50 px-4 py-3 text-indigo-800 dark:border-indigo-900/50 dark:bg-indigo-950/30 dark:text-indigo-300 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm dark:bg-slate-900 dark:text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold">
                        {{ $selectedCount }} application(s) selected
                    </p>
                    <p class="text-xs text-indigo-700/80 dark:text-indigo-300/80">
                        You may now assign these applications to an available training batch.
                    </p>
                </div>
            </div>

            <button
                type="button"
                wire:click.prevent="assignTrainingBatch()"
                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                Assign Now
            </button>
        </div>
        @endif

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto border-t border-slate-100 dark:border-slate-800">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3">
                            <input
                                type="checkbox"
                                wire:model.live="selectAll"
                                class="h-4 w-4 rounded border-slate-300 bg-slate-100 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-800">
                        </th>
                        <th class="px-5 py-3 font-semibold">Application No.</th>
                        <th class="px-5 py-3 font-semibold">Applicant</th>
                        <th class="px-5 py-3 font-semibold">Training Course</th>
                        <th class="px-5 py-3 font-semibold">Training Center</th>
                        <th class="px-5 py-3 font-semibold">Assigned Batch</th>
                        <th class="px-5 py-3 font-semibold">Application Date</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse ($applicants as $applicant)
                    @php
                    $isSelected = in_array($applicant->id, $selectedIds ?? []);

                    $statusColors = [
                    'pending' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300',
                    'approved' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300',
                    'rejected' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300',
                    ];
                    @endphp

                    <tr wire:key="applicant-row-{{ $applicant->id }}"
                        class="transition {{ $isSelected ? 'bg-indigo-50/70 dark:bg-indigo-950/20' : 'hover:bg-slate-50/80 dark:hover:bg-slate-800/60' }}">

                        {{-- Checkbox --}}
                        <td class="px-5 py-4 align-top">
                            <input
                                type="checkbox"
                                wire:model.live="selectedIds"
                                value="{{ $applicant->id }}"
                                class="h-4 w-4 rounded border-slate-300 bg-slate-100 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-800">
                        </td>

                        {{-- Application No --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 font-mono text-xs font-semibold uppercase text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ $applicant->application_number }}
                            </span>
                        </td>

                        {{-- Applicant --}}
                        <th scope="row" class="px-5 py-4 align-top">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50 dark:border-indigo-900/50 dark:bg-indigo-950/40">
                                    <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                        {{ strtoupper(substr($applicant->name ?? 'A', 0, 1)) }}{{ strtoupper(substr($applicant->last_name ?? '', 0, 1)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold uppercase tracking-wide text-slate-900 dark:text-white">
                                        {{ $applicant->name }} {{ $applicant->last_name }}
                                    </p>

                                    @if($applicant->email)
                                    <p class="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400">
                                        {{ $applicant->email }}
                                    </p>
                                    @endif

                                    @if($applicant->contact_number)
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                        {{ $applicant->contact_number }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </th>

                        {{-- Training Course --}}
                        <td class="px-5 py-4 align-top">
                            <div class="min-w-48">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                                    {{ $applicant->course_name }}
                                </p>
                                <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                    {{ $applicant->course_code }}
                                </p>
                            </div>
                        </td>

                        {{-- Training Center --}}
                        <td class="px-5 py-4 align-top">
                            <div class="min-w-48">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                                    {{ $applicant->center_name }}
                                </p>
                                <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                    {{ $applicant->center_code }}
                                </p>
                            </div>
                        </td>

                        {{-- Assigned Batch --}}
                        <td class="px-5 py-4 align-top">
                            @if($applicant->batch_name)
                            <div class="min-w-48">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                                    {{ $applicant->batch_name }}
                                </p>
                                <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                    {{ $applicant->batch_code }}
                                </p>
                            </div>
                            @else
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                No batch assigned
                            </span>
                            @endif
                        </td>

                        {{-- Application Date --}}
                        <td class="px-5 py-4 align-top whitespace-nowrap">
                            <span class="text-sm text-slate-600 dark:text-slate-300">
                                {{ date('M d, Y', strtotime($applicant->application_date)) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusColors[$applicant->status] ?? 'border-slate-200 bg-slate-50 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300' }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ ucfirst($applicant->status) }}
                            </span>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2.25 4H6.75A2.25 2.25 0 014.5 17.75V6.25A2.25 2.25 0 016.75 4h6.879a2.25 2.25 0 011.591.659l3.621 3.621a2.25 2.25 0 01.659 1.591v7.879A2.25 2.25 0 0117.25 20z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No applicants found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your center, course, or search filter.
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ===== PAGINATION ===== --}}
        @if ($applicants->hasPages())
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-xs text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->firstItem() }}</span>
                –
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->lastItem() }}</span>
                of
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->total() }}</span>
                applications
            </div>

            <div>
                {{ $applicants->links() }}
            </div>
        </div>
        @endif
    </div>

    {{-- ===== ASSIGN BATCH MODAL ===== --}}
    @if($openAssignBatchModal)
    @php
    $modalCourse = collect($trainingCourses)->firstWhere('id', $trainingCourseId);
    $modalCenter = collect($trainingCenters)->firstWhere('id', $trainingCenterId);
    @endphp

    <div class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            wire:click="$set('openAssignBatchModal', false)"></div>

        <div class="relative z-10 w-full max-w-2xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-700 dark:bg-slate-900">

            {{-- Modal Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-950 dark:text-white">
                                Assign Training Batch
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Assigning batch to {{ count($selectedIds ?? []) }} selected application(s).
                            </p>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="$set('openAssignBatchModal', false)"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="max-h-[70vh] space-y-5 overflow-y-auto px-5 py-5">

                {{-- Selected Context --}}
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-800/60">
                        <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Training Course
                        </p>
                        <p class="text-sm font-semibold text-slate-950 dark:text-white">
                            {{ $modalCourse?->course_name ?? '—' }}
                        </p>
                        <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                            {{ $modalCourse?->course_code ?? '' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-slate-700 dark:bg-slate-800/60">
                        <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Training Center
                        </p>
                        <p class="text-sm font-semibold text-slate-950 dark:text-white">
                            {{ $modalCenter?->name ?? '—' }}
                        </p>
                        <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                            {{ $modalCenter?->code ?? $modalCenter?->center_code ?? '' }}
                        </p>
                    </div>
                </div>

                {{-- Batch List --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Select Batch <span class="text-rose-500">*</span>
                    </label>

                    @if($trainingBatches->isEmpty())
                    <div class="flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-amber-600 shadow-sm dark:bg-slate-900 dark:text-amber-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM10.29 3.86L1.82 18a2.25 2.25 0 001.93 3.375h16.5A2.25 2.25 0 0022.18 18L13.71 3.86a2.25 2.25 0 00-3.42 0z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                No available batches found
                            </p>
                            <p class="mt-0.5 text-xs text-amber-700/80 dark:text-amber-300/80">
                                There are no available batches for the selected course and center.
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="max-h-64 space-y-2 overflow-y-auto pr-1">
                        @foreach($trainingBatches as $batch)
                        <label
                            wire:key="batch-option-{{ $batch->id }}"
                            class="flex cursor-pointer items-start gap-3 rounded-2xl border p-3 transition
                            {{ $trainingBatchId == $batch->id
                                ? 'border-indigo-400 bg-indigo-50 shadow-sm dark:border-indigo-500 dark:bg-indigo-950/30'
                                : 'border-slate-200 bg-white hover:border-indigo-200 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:hover:bg-slate-800' }}">

                            <input
                                type="radio"
                                wire:model.live="trainingBatchId"
                                value="{{ $batch->id }}"
                                class="mt-1 h-4 w-4 border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-800">

                            <div class="min-w-0 flex-1">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-950 dark:text-white">
                                            {{ $batch->batch_name }}
                                        </p>
                                        <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                            {{ $batch->batch_code }}
                                        </p>
                                    </div>

                                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold
                                        {{ $batch->status === 'open'
                                            ? 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300'
                                            : 'border-blue-200 bg-blue-50 text-blue-700 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300' }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ ucfirst($batch->status) }}
                                    </span>
                                </div>

                                <p class="mt-2 inline-flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6.75A2.25 2.25 0 016.75 4.5h10.5A2.25 2.25 0 0119.5 6.75v12A2.25 2.25 0 0117.25 21H6.75A2.25 2.25 0 014.5 18.75v-12z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                    –
                                    {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}
                                </p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    @error('trainingBatchId')
                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-end">
                <button
                    type="button"
                    wire:click="$set('openAssignBatchModal', false)"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                    Cancel
                </button>

                <button
                    type="button"
                    wire:click="confirmBatchAssignment"
                    wire:loading.attr="disabled"
                    wire:target="confirmBatchAssignment"
                    @disabled($trainingBatches->isEmpty() || !$trainingBatchId)
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-indigo-500 dark:hover:bg-indigo-600">

                    <svg wire:loading.remove wire:target="confirmBatchAssignment" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>

                    <svg wire:loading wire:target="confirmBatchAssignment" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>

                    <span wire:loading.remove wire:target="confirmBatchAssignment">Assign Batch</span>
                    <span wire:loading wire:target="confirmBatchAssignment">Assigning...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('open-pdf', (event) => {
                const base64 = event.pdf;
                const byteCharacters = atob(base64);
                const byteNumbers = Array.from(byteCharacters, c => c.charCodeAt(0));
                const byteArray = new Uint8Array(byteNumbers);

                const blob = new Blob([byteArray], {
                    type: 'application/pdf'
                });

                const blobUrl = URL.createObjectURL(blob);
                const win = window.open(blobUrl, '_blank');

                if (win) {
                    win.onload = () => win.print();
                }
            });
        });
    </script>
</div>