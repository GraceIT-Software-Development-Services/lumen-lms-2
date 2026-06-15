<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72A8.986 8.986 0 006 18.719M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Registered Applicants
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Review, update, enroll, and print learner application forms.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    {{-- Total Badge --}}
                    <div class="inline-flex w-fit items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        Total Applicants
                        <span class="ml-2 rounded-lg bg-slate-100 px-2 py-1 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                            {{ method_exists($applicants, 'total') ? $applicants->total() : count($applicants) }}
                        </span>
                    </div>

                    {{-- Search --}}
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            placeholder="Search name, ULI, etc."
                            wire:model.live.debounce.300ms="search"
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

                    {{-- New Application --}}
                    <a href="{{ route('learner-applications.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Application
                    </a>
                </div>
            </div>
        </div>

        {{-- Livewire Loading Bar --}}
        <div wire:loading wire:target="search,printForm" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
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

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto border-t border-slate-100 dark:border-slate-800">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">ULI</th>
                        <th class="px-5 py-3 font-semibold">Applicant</th>
                        <th class="px-5 py-3 font-semibold">Sex</th>
                        <th class="px-5 py-3 font-semibold">Birth Date</th>
                        <th class="px-5 py-3 font-semibold">Civil Status</th>
                        <th class="px-5 py-3 font-semibold">Contact</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse ($applicants as $applicant)
                    @php
                    $fullName = trim(
                    ($applicant->name ?? '') . ' ' .
                    ($applicant->middle_name ? $applicant->middle_name . ' ' : '') .
                    ($applicant->last_name ?? '')
                    );

                    $initials = strtoupper(substr($applicant->name ?? 'L', 0, 1)) . strtoupper(substr($applicant->last_name ?? 'A', 0, 1));

                    $address = collect([
                    $applicant->address_number_street,
                    $applicant->address_barangay,
                    $applicant->address_city,
                    $applicant->address_province
                    ])->filter()->implode(', ');
                    @endphp

                    <tr wire:key="registered-applicant-{{ $applicant->uuid }}" class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

                        {{-- # --}}
                        <td class="px-5 py-4 align-top text-sm font-medium text-slate-400 dark:text-slate-500">
                            {{ $loop->iteration + ($applicants->currentPage() - 1) * $applicants->perPage() }}
                        </td>

                        {{-- ULI --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-2.5 py-1 font-mono text-xs font-semibold uppercase text-indigo-700 dark:border-indigo-900/50 dark:bg-indigo-950/30 dark:text-indigo-300">
                                {{ strtoupper($applicant->uli) }}
                            </span>
                        </td>

                        {{-- Applicant --}}
                        <th scope="row" class="px-5 py-4 align-top">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50 dark:border-indigo-900/50 dark:bg-indigo-950/40">
                                    <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                        {{ $initials }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold uppercase tracking-wide text-slate-900 dark:text-white">
                                        {{ $fullName }}
                                    </p>

                                    <p class="mt-1 max-w-sm text-xs leading-relaxed text-slate-500 line-clamp-2 dark:text-slate-400">
                                        {{ $address ?: 'No address provided' }}
                                    </p>
                                </div>
                            </div>
                        </th>

                        {{-- Sex --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ ucwords($applicant->sex) }}
                            </span>
                        </td>

                        {{-- Birth Date --}}
                        <td class="px-5 py-4 align-top whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-600 dark:text-slate-300">
                                <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ date('M d, Y', strtotime($applicant->birth_date)) }}
                            </span>
                        </td>

                        {{-- Civil Status --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                {{ ucwords($applicant->civil_status) }}
                            </span>
                        </td>

                        {{-- Contact --}}
                        <td class="px-5 py-4 align-top whitespace-nowrap">
                            @if(!empty($applicant->contact_mobile))
                            <span class="inline-flex items-center gap-1.5 text-sm text-slate-600 dark:text-slate-300">
                                <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372a1.125 1.125 0 00-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38 12.035 12.035 0 01-7.143-7.143 1.125 1.125 0 01.38-1.21l1.293-.97a1.125 1.125 0 00.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                {{ $applicant->contact_mobile }}
                            </span>
                            @else
                            <span class="text-xs text-slate-400 dark:text-slate-500">—</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-5 py-4 text-right align-top">
                            <div class="flex flex-wrap items-center justify-end gap-2">

                                <a href="{{ route('update-registered-learner.edit', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-blue-100 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-500/10 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Update
                                </a>

                                <a href="{{ route('learner-training-applications.register.existing.application', $applicant->uuid) }}"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Enroll
                                </a>

                                <button
                                    type="button"
                                    wire:click="printForm('{{ $applicant->uuid }}')"
                                    wire:loading.attr="disabled"
                                    wire:target="printForm('{{ $applicant->uuid }}')"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-violet-100 bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700 transition hover:bg-violet-100 focus:outline-none focus:ring-4 focus:ring-violet-500/10 disabled:cursor-not-allowed disabled:opacity-60 dark:border-violet-900/50 dark:bg-violet-950/30 dark:text-violet-300">

                                    <svg wire:loading.remove wire:target="printForm('{{ $applicant->uuid }}')" class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6 18.75A2.25 2.25 0 008.25 21h7.5A2.25 2.25 0 0018 18.75l-.72-4.921m0 0c.24.03.48.062.72.096m-.72-.096L16.5 8.25A2.25 2.25 0 0014.25 6h-4.5A2.25 2.25 0 007.5 8.25l-.78 5.579M9 6V3.75A.75.75 0 019.75 3h4.5a.75.75 0 01.75.75V6" />
                                    </svg>

                                    <svg wire:loading wire:target="printForm('{{ $applicant->uuid }}')" class="h-3.5 w-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>

                                    <span wire:loading.remove wire:target="printForm('{{ $applicant->uuid }}')">Form</span>
                                    <span wire:loading wire:target="printForm('{{ $applicant->uuid }}')">Opening...</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No applicants found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your search or add a new application.
                                    </p>
                                </div>

                                <a href="{{ route('learner-applications.create') }}"
                                    class="mt-2 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Application
                                </a>
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