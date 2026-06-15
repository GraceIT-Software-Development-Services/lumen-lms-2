<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Training Applicants
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Review applications, applicant details, assigned batches, and training status.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    {{-- Registered Applicants Button --}}
                    <a href="{{ route('learner-training-applications.list.registered.applicants') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-semibold text-amber-700 shadow-sm transition hover:bg-amber-100 focus:outline-none focus:ring-4 focus:ring-amber-500/10 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Registered Applicants
                    </a>

                    {{-- Search --}}
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 sm:w-80"
                            placeholder="Search applicants...">

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

        {{-- Livewire Loading Bar --}}
        <div wire:loading wire:target="search,cancelApplication,assignBatch" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-indigo-500"></div>
        </div>

        {{-- ===== FLASH MESSAGES ===== --}}
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

        {{-- ===== MINI SUMMARY ===== --}}
        <div class="grid grid-cols-1 gap-3 p-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Total</p>
                        <p class="mt-1 text-2xl font-bold text-slate-950 dark:text-white">{{ number_format($totalAppplication) }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm dark:bg-slate-900 dark:text-slate-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-8.25A3.375 3.375 0 004.5 11.625v2.625m15 0A2.25 2.25 0 0117.25 16.5H6.75A2.25 2.25 0 014.5 14.25m15 0v2.625A3.375 3.375 0 0116.125 20.25h-8.25A3.375 3.375 0 014.5 16.875V14.25" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 dark:border-amber-900/50 dark:bg-amber-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-amber-700 dark:text-amber-300">Pending</p>
                        <p class="mt-1 text-2xl font-bold text-amber-800 dark:text-amber-200">{{ number_format($totalPendingAppplication) }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-amber-600 shadow-sm dark:bg-slate-900 dark:text-amber-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">Approved</p>
                        <p class="mt-1 text-2xl font-bold text-emerald-800 dark:text-emerald-200">{{ number_format($totalApprovedAppplication) }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm dark:bg-slate-900 dark:text-emerald-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 dark:border-rose-900/50 dark:bg-rose-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-rose-700 dark:text-rose-300">Cancelled</p>
                        <p class="mt-1 text-2xl font-bold text-rose-800 dark:text-rose-200">{{ number_format($totalCancelledAppplication) }}</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm dark:bg-slate-900 dark:text-rose-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto border-t border-slate-100 dark:border-slate-800">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Application No.</th>
                        <th class="px-5 py-3 font-semibold">Applicant</th>
                        <th class="px-5 py-3 font-semibold">Training Course</th>
                        <th class="px-5 py-3 font-semibold">Training Center</th>
                        <th class="px-5 py-3 font-semibold">Assigned Batch</th>
                        <th class="px-5 py-3 font-semibold">Application Date</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse ($applicants as $applicant)
                    @php
                    $status = strtolower($applicant->status ?? 'pending');

                    $statusColors = [
                    'pending' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300',
                    'approved' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300',
                    'rejected' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300',
                    'cancelled' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300',
                    ];

                    $statusBadge = $statusColors[$status] ?? 'border-slate-200 bg-slate-50 text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300';
                    @endphp

                    <tr wire:key="applicant-{{ $applicant->uuid }}" class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

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
                                        {{ strtoupper(substr($applicant->full_name_searchable ?? 'A', 0, 1)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold uppercase tracking-wide text-slate-900 dark:text-white">
                                        {{ $applicant->full_name_searchable }}
                                    </p>

                                    <div class="mt-1 space-y-0.5">
                                        <p class="truncate text-xs text-slate-500 dark:text-slate-400">
                                            {{ $applicant->email }}
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $applicant->contact_number }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </th>

                        {{-- Training Course --}}
                        <td class="px-5 py-4 align-top">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $applicant->course_name }}
                                </p>
                                <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                    {{ $applicant->course_code }}
                                </p>
                            </div>
                        </td>

                        {{-- Training Center --}}
                        <td class="px-5 py-4 align-top">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
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
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $applicant->batch_name }}
                                </p>
                                <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                    {{ $applicant->batch_code }}
                                </p>
                            </div>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                No batch assigned
                            </span>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td class="px-5 py-4 align-top">
                            <span class="whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ date('M d, Y', strtotime($applicant->application_date)) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusBadge }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ ucfirst($applicant->status) }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td class="px-5 py-4 text-right align-top">
                            @if ($applicant->status == "pending")
                            <button
                                type="button"
                                wire:click.prevent="cancelApplication('{{ $applicant->uuid }}')"
                                wire:confirm="Are you sure you want to cancel this application? This action cannot be undone."
                                wire:loading.attr="disabled"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 transition hover:bg-amber-100 focus:outline-none focus:ring-4 focus:ring-amber-500/10 disabled:cursor-not-allowed disabled:opacity-60 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                            @else
                            <span class="text-xs text-slate-400 dark:text-slate-500">—</span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No applicants found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your search.
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
        @if ($applicants->hasPages())
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-xs text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->firstItem() }}</span>
                –
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->lastItem() }}</span>
                of
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $applicants->total() }}</span>
                applicants
            </div>

            <div>
                {{ $applicants->links() }}
            </div>
        </div>
        @endif
    </div>

    {{-- ===== MODAL ===== --}}
    @if($openModalOnlineApplication)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm">
        <div class="relative w-full max-w-4xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-700 dark:bg-slate-900">

            {{-- Modal Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-emerald-600 to-indigo-600 px-5 py-4 dark:border-slate-800">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-semibold text-white">
                                Select Available Batch
                            </h3>
                            <p class="mt-0.5 text-sm text-emerald-50">
                                Choose an open batch for this online application.
                            </p>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="toggleModalOnlineApplication"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-white/70 transition hover:bg-white/15 hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 14 14" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="max-h-[70vh] overflow-y-auto p-5">
                @if(session()->has('message'))
                <div class="mb-4 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-950/30 dark:text-emerald-300">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm dark:bg-slate-900 dark:text-emerald-300">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
                @endif

                @if($batches->count() > 0)
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-800 dark:text-slate-100">
                            Choose a batch
                        </label>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            Select one available batch to approve and assign the applicant.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-3">
                        @foreach($batches as $batch)
                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                wire:model="selectedBatchId"
                                value="{{ $batch->id }}"
                                class="peer sr-only">

                            <div class="rounded-2xl border p-4 transition hover:border-emerald-300 hover:bg-emerald-50/50 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:ring-4 peer-checked:ring-emerald-500/10 dark:border-slate-700 dark:hover:border-emerald-700 dark:hover:bg-emerald-950/20 dark:peer-checked:border-emerald-600 dark:peer-checked:bg-emerald-950/30">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-slate-300 bg-white transition peer-checked:border-emerald-500 peer-checked:bg-emerald-500 dark:border-slate-600 dark:bg-slate-900">
                                            <span class="h-2 w-2 rounded-full bg-white opacity-0 transition peer-checked:opacity-100"></span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                {{ $batch->batch_name }}
                                            </p>
                                            <p class="mt-0.5 font-mono text-xs text-slate-500 dark:text-slate-400">
                                                {{ $batch->batch_code }}
                                            </p>

                                            <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-500 dark:text-slate-400">
                                                <span>
                                                    Start:
                                                    <span class="font-semibold text-slate-700 dark:text-slate-200">
                                                        {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                                    </span>
                                                </span>

                                                @if($batch->end_date)
                                                <span>
                                                    End:
                                                    <span class="font-semibold text-slate-700 dark:text-slate-200">
                                                        {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }}
                                                    </span>
                                                </span>
                                                @endif

                                                @if($batch->max_participants)
                                                <span>
                                                    Capacity:
                                                    <span class="font-semibold text-slate-700 dark:text-slate-200">
                                                        {{ $batch->registered_students_count ?? 0 }}/{{ $batch->max_participants }}
                                                    </span>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ ucfirst($batch->status) }}
                                    </span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>

                    @error('selectedBatchId')
                    <p class="text-xs font-medium text-rose-500 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
                @else
                <div class="py-14 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                        <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <p class="mt-3 text-sm font-semibold text-slate-600 dark:text-slate-300">
                        No available batches
                    </p>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                        There are no open batches available at the moment.
                    </p>
                </div>
                @endif
            </div>

            {{-- Modal Footer --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-end">
                <button
                    wire:click="toggleModalOnlineApplication"
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                    Cancel
                </button>

                <button
                    wire:click="assignBatch"
                    wire:confirm="Are you sure you want to approve and assign this learner to this training batch? This action cannot be undone."
                    wire:loading.attr="disabled"
                    wire:target="assignBatch"
                    type="button"
                    {{ $batches->count() == 0 ? 'disabled' : '' }}
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-emerald-500 dark:hover:bg-emerald-600">

                    <svg wire:loading.remove wire:target="assignBatch" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>

                    <svg wire:loading wire:target="assignBatch" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>

                    <span wire:loading.remove wire:target="assignBatch">Confirm Selection</span>
                    <span wire:loading wire:target="assignBatch">Processing...</span>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>