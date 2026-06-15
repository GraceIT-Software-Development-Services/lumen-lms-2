<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-indigo-50 to-blue-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-indigo-100 bg-indigo-50 text-indigo-600 dark:border-indigo-900/50 dark:bg-indigo-950/40 dark:text-indigo-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Association Management
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Manage association, cooperative, and company records with address and membership details.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="inline-flex w-fit items-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-500 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        Total Records
                        <span class="ml-2 rounded-lg bg-slate-100 px-2 py-1 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                            {{ method_exists($associations, 'total') ? $associations->total() : count($associations) }}
                        </span>
                    </div>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>

                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 sm:w-72"
                            placeholder="Search association...">

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

                    <button
                        type="button"
                        wire:click.prevent="toggleModal"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Association
                    </button>
                </div>
            </div>
        </div>

        {{-- Livewire Loading Bar --}}
        <div wire:loading wire:target="search,save,deleteAssociation,editAssociation" class="h-1 w-full overflow-hidden bg-indigo-50 dark:bg-indigo-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-indigo-500"></div>
        </div>

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500 dark:text-slate-400">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:bg-slate-800/70 dark:text-slate-400">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Name</th>
                        <th class="px-5 py-3 font-semibold">Type</th>
                        <th class="px-5 py-3 font-semibold">Address</th>
                        <th class="px-5 py-3 font-semibold">Description</th>
                        <th class="px-5 py-3 font-semibold">Members</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white dark:divide-slate-800 dark:bg-slate-900">
                    @forelse($associations as $association)
                    @php
                    $type = $association->type ?? 'Association';

                    $typeBadge = match($type) {
                    'Cooperative' => 'border-emerald-100 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300',
                    'Company' => 'border-blue-100 bg-blue-50 text-blue-700 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300',
                    default => 'border-indigo-100 bg-indigo-50 text-indigo-700 dark:border-indigo-900/50 dark:bg-indigo-950/30 dark:text-indigo-300',
                    };
                    @endphp

                    <tr wire:key="association-{{ $association->uuid }}" class="transition hover:bg-slate-50/80 dark:hover:bg-slate-800/60">

                        {{-- Row number --}}
                        <td class="px-5 py-4 align-top text-sm font-medium text-slate-400 dark:text-slate-500">
                            {{ $loop->iteration + ($associations->currentPage() - 1) * $associations->perPage() }}
                        </td>

                        {{-- Name --}}
                        <th scope="row" class="px-5 py-4 align-top">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50 dark:border-indigo-900/50 dark:bg-indigo-950/40">
                                    <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300">
                                        {{ strtoupper(substr($association->name ?? 'A', 0, 2)) }}
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold uppercase tracking-wide text-slate-900 dark:text-white">
                                        {{ $association->name }}
                                    </p>
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">
                                        Association Record
                                    </p>
                                </div>
                            </div>
                        </th>

                        {{-- Type --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $typeBadge }}">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $type }}
                            </span>
                        </td>

                        {{-- Address --}}
                        <td class="px-5 py-4 align-top">
                            @if(!empty($association->address))
                            <p class="max-w-xs text-sm leading-relaxed text-slate-600 line-clamp-2 dark:text-slate-300">
                                {{ $association->address }}
                            </p>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-500">
                                No address
                            </span>
                            @endif
                        </td>

                        {{-- Description --}}
                        <td class="px-5 py-4 align-top">
                            @if(!empty($association->description))
                            <p class="max-w-xs text-sm leading-relaxed text-slate-600 line-clamp-2 dark:text-slate-300">
                                {{ $association->description }}
                            </p>
                            @else
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-500">
                                No description
                            </span>
                            @endif
                        </td>

                        {{-- Members count --}}
                        <td class="px-5 py-4 align-top">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $association->members_count ?? 0 }} members
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-5 py-4 text-right align-top">
                            <div class="flex flex-wrap items-center justify-end gap-2">
                                <button
                                    type="button"
                                    wire:click.prevent="editAssociation('{{ $association->uuid }}')"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-amber-100 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 transition hover:bg-amber-100 focus:outline-none focus:ring-4 focus:ring-amber-500/10 disabled:cursor-not-allowed disabled:opacity-60 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-300">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    wire:click.prevent="deleteAssociation('{{ $association->uuid }}')"
                                    wire:confirm="Are you sure you want to delete this association?"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-rose-100 bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-4 focus:ring-rose-500/10 disabled:cursor-not-allowed disabled:opacity-60 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                                    <svg class="h-7 w-7 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                        No associations found
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                                        Try adjusting your search or add a new record.
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    wire:click.prevent="toggleModal"
                                    class="mt-2 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Association
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($associations->hasPages())
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-xs text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $associations->firstItem() }}</span>
                –
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $associations->lastItem() }}</span>
                of
                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $associations->total() }}</span>
                records
            </div>

            <div>
                {{ $associations->links() }}
            </div>
        </div>
        @endif
    </div>

    {{-- ===== MODAL ===== --}}
    @if($showModal)
    <div tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm">
        <div class="relative w-full max-w-2xl">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-700 dark:bg-slate-900">

                {{-- Modal Header --}}
                <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-600 to-blue-600 px-5 py-4 dark:border-slate-800">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15 text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-white">
                                    {{ $editingUuid ? 'Edit Association' : 'Add Association' }}
                                </h3>
                                <p class="mt-0.5 text-xs text-indigo-100">
                                    {{ $editingUuid ? 'Update record details' : 'Create a new association record' }}
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            wire:click="closeModal"
                            class="rounded-xl p-2 text-white/70 transition hover:bg-white/15 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Modal Body --}}
                <div class="max-h-[70vh] overflow-y-auto px-5 py-5">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        {{-- Name --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Name <span class="text-rose-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model="name"
                                placeholder="e.g. Teachers Association"
                                class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('name') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 @enderror">

                            @error('name')
                            <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600 dark:text-rose-400">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div>
                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Type <span class="text-rose-500">*</span>
                            </label>

                            <select
                                wire:model="type"
                                class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('type') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 @enderror">
                                <option value="">Select type</option>
                                <option value="Cooperative">Cooperative</option>
                                <option value="Association">Association</option>
                                <option value="Company">Company</option>
                            </select>

                            @error('type')
                            <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Address
                            </label>

                            <input
                                type="text"
                                wire:model="address"
                                placeholder="Enter address"
                                class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('address') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 @enderror">

                            @error('address')
                            <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                Description
                            </label>

                            <textarea
                                wire:model="description"
                                rows="3"
                                placeholder="Optional description..."
                                class="block w-full resize-y rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('description') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 @enderror"></textarea>

                            @error('description')
                            <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-end">
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                        Cancel
                    </button>

                    <button
                        type="button"
                        wire:click="save"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 disabled:cursor-not-allowed disabled:opacity-70 dark:bg-indigo-500 dark:hover:bg-indigo-600">

                        <svg wire:loading.remove wire:target="save" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <svg wire:loading wire:target="save" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="save">
                            {{ $editingUuid ? 'Update Association' : 'Save Association' }}
                        </span>
                        <span wire:loading wire:target="save">
                            Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>