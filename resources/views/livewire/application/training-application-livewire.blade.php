<div class="mx-auto max-w-full space-y-5">
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm ring-1 ring-slate-950/5 dark:border-slate-800 dark:bg-slate-900 dark:ring-white/5">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-200 bg-gradient-to-br from-white via-slate-50 to-emerald-50/60 px-4 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-900 dark:to-emerald-950/20 sm:px-6">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div class="flex min-w-0 items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-600 shadow-sm dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h6m2 13H7a2 2 0 01-2-2V5a2 2 0 012-2h6.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0119 8.414V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Learner Training Applications
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage, review, and monitor learner training applications.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-80">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            placeholder="Search application..."
                            wire:model.live="search"
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 shadow-sm outline-none transition duration-150 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-emerald-400">
                    </div>

                    <a href="{{ route('learner-training-applications.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-emerald-600/20 transition duration-150 hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        New Application
                    </a>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if(session()->has('success'))
        <div class="mx-4 mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/30 dark:text-emerald-300 sm:mx-6">
            <div class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="mx-4 mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/60 dark:bg-rose-950/30 dark:text-rose-300 sm:mx-6">
            <div class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        {{-- ===== MINI SUMMARY ===== --}}
        <div class="grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 lg:grid-cols-4 sm:p-6">
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-800 dark:bg-slate-800/60">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums text-slate-950 dark:text-white">
                            {{ $applications->total() }}
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5A3.375 3.375 0 0010.125 2.25H8.25M8.25 18.75h7.5M8.25 15.75h7.5M8.25 12.75h3M3.75 6.75v10.5A2.25 2.25 0 006 19.5h12a2.25 2.25 0 002.25-2.25V9.75a2.25 2.25 0 00-.659-1.591l-5.25-5.25a2.25 2.25 0 00-1.591-.659H6A2.25 2.25 0 003.75 4.5v2.25z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">all submitted applications</p>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50/80 p-4 dark:border-amber-900/60 dark:bg-amber-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-700 dark:text-amber-300">Pending</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums text-amber-800 dark:text-amber-200">
                            {{ $applications->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-amber-200 bg-white/70 text-amber-600 dark:border-amber-900/60 dark:bg-amber-950/40 dark:text-amber-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs text-amber-700/70 dark:text-amber-300/70">waiting for review</p>
            </div>

            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4 dark:border-emerald-900/60 dark:bg-emerald-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-300">Approved</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums text-emerald-800 dark:text-emerald-200">
                            {{ $applications->where('status', 'approved')->count() }}
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-emerald-200 bg-white/70 text-emerald-600 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs text-emerald-700/70 dark:text-emerald-300/70">accepted applications</p>
            </div>

            <div class="rounded-2xl border border-violet-200 bg-violet-50/80 p-4 dark:border-violet-900/60 dark:bg-violet-950/30">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-violet-700 dark:text-violet-300">With Batch</p>
                        <p class="mt-1 text-3xl font-bold tabular-nums text-violet-800 dark:text-violet-200">
                            {{ $applications->filter(fn($application) => !empty($application->batch_name))->count() }}
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-violet-200 bg-white/70 text-violet-600 dark:border-violet-900/60 dark:bg-violet-950/40 dark:text-violet-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 21h15a.75.75 0 00.75-.75v-15A.75.75 0 0019.5 4.5h-15a.75.75 0 00-.75.75v15c0 .414.336.75.75.75z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-xs text-violet-700/70 dark:text-violet-300/70">assigned to training batch</p>
            </div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="border-t border-slate-200 dark:border-slate-800">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1180px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 dark:border-slate-800 dark:bg-slate-800/70 dark:text-slate-400">
                            <th class="px-6 py-3 font-semibold">#</th>
                            <th class="px-6 py-3 font-semibold">Application No.</th>
                            <th class="px-6 py-3 font-semibold">Training Center</th>
                            <th class="px-6 py-3 font-semibold">Training Course</th>
                            <th class="px-6 py-3 font-semibold">Application Date</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                            <th class="px-6 py-3 font-semibold">Reviewed By</th>
                            <th class="px-6 py-3 font-semibold">Reviewed At</th>
                            <th class="px-6 py-3 font-semibold">Remarks</th>
                            <th class="px-6 py-3 text-right font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                        @forelse ($applications as $application)
                        <tr class="group transition-colors duration-150 hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

                            {{-- # --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                    {{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}
                                </span>
                            </td>

                            {{-- Application Number --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-2.5 py-1 font-mono text-xs font-semibold text-indigo-700 dark:border-indigo-900/60 dark:bg-indigo-950/30 dark:text-indigo-300">
                                    {{ $application->application_number }}
                                </span>
                            </td>

                            {{-- Training Center --}}
                            <th scope="row" class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-indigo-100 bg-indigo-50 dark:border-indigo-900/60 dark:bg-indigo-950/30">
                                        <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                            {{ strtoupper(substr($application->name ?? 'C', 0, 1)) }}
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <span class="block max-w-[220px] truncate text-xs font-semibold uppercase tracking-wide text-slate-900 dark:text-white">
                                            {{ $application->name }}
                                        </span>
                                        <span class="mt-0.5 block text-xs text-slate-500 dark:text-slate-400">
                                            Training Center
                                        </span>
                                    </div>
                                </div>
                            </th>

                            {{-- Course --}}
                            <td class="px-6 py-4">
                                <div class="min-w-0">
                                    <span class="block max-w-[240px] truncate font-medium text-slate-800 dark:text-slate-100">
                                        {{ $application->course_name }}
                                    </span>
                                    <span class="mt-0.5 inline-flex items-center rounded-md bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                        {{ $application->course_code }}
                                    </span>
                                </div>
                            </td>

                            {{-- Application Date --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 dark:text-slate-300">
                                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ date('M d, Y', strtotime($application->application_date)) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                @php
                                $status = strtolower($application->status);
                                $statusColors = [
                                'approved' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/60 dark:bg-emerald-950/30 dark:text-emerald-300',
                                'pending' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/60 dark:bg-amber-950/30 dark:text-amber-300',
                                'rejected' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/60 dark:bg-rose-950/30 dark:text-rose-300',
                                'cancelled' => 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/60 dark:bg-rose-950/30 dark:text-rose-300',
                                ];
                                $statusDots = [
                                'approved' => 'bg-emerald-500',
                                'pending' => 'bg-amber-500',
                                'rejected' => 'bg-rose-500',
                                'cancelled' => 'bg-rose-500',
                                ];
                                @endphp

                                <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusColors[$status] ?? 'border-slate-200 bg-slate-50 text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusDots[$status] ?? 'bg-slate-400' }}"></span>
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>

                            {{-- Reviewed By --}}
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600 dark:text-slate-300">
                                    {{ $application->reviewed_by ?? '—' }}
                                </span>
                            </td>

                            {{-- Reviewed At --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="text-sm text-slate-600 dark:text-slate-300">
                                    {{ $application->reviewed_at ? date('M d, Y', strtotime($application->reviewed_at)) : '—' }}
                                </span>
                            </td>

                            {{-- Remarks --}}
                            <td class="px-6 py-4">
                                <p class="max-w-xs truncate text-sm text-slate-600 dark:text-slate-300">
                                    {{ $application->reviewed_remarks ?? '—' }}
                                </p>
                            </td>

                            {{-- Action --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="{{ route('learner-training-applications.show', $application->uuid) }}"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 transition duration-150 hover:border-emerald-300 hover:bg-emerald-100 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 dark:border-emerald-900/60 dark:bg-emerald-950/30 dark:text-emerald-300 dark:hover:bg-emerald-900/40">
                                    View
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-16 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                        <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                            No training applications found
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                            Try adjusting your search or create a new application.
                                        </p>
                                    </div>
                                    <a href="{{ route('learner-training-applications.create') }}"
                                        class="mt-2 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition duration-150 hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-400">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Create Application
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($applications->hasPages())
        <div class="border-t border-slate-200 bg-slate-50/70 px-4 py-4 dark:border-slate-800 dark:bg-slate-800/60 sm:px-6">
            {{ $applications->links() }}
        </div>
        @endif
    </div>
</div>