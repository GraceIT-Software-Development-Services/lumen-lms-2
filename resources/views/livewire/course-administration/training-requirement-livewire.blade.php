<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-xs border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- ===== HEADER ===== --}}
        <div class="p-4 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $courseName }} - Training Requirements
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                        Define and manage required documents or prerequisites for this course.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <div class="hidden sm:inline-flex items-center rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-xs text-gray-500 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        Total:
                        <span class="ml-1 font-semibold text-gray-800 dark:text-white">{{ count($requirements) }}</span>
                    </div>

                    <button wire:click="addRequirement"
                        class="inline-flex items-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Add Requirement
                    </button>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        @if(session()->has('success'))
        <div class="m-4 p-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-900 dark:bg-emerald-900/30 dark:text-emerald-300">
            {{ session('success') }}
        </div>
        @endif

        {{-- ===== TABLE ===== --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Requirement Name</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($requirements as $index => $req)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 transition-colors duration-150 align-top">

                        {{-- # --}}
                        <td class="w-4 p-4">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- Requirement --}}
                        <td class="px-6 py-4">
                            <input
                                type="text"
                                wire:model="requirements.{{ $index }}.requirement_name"
                                placeholder="Requirement name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

                            @error("requirements.$index.requirement_name")
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                            @enderror
                        </td>

                        {{-- Description --}}
                        <td class="px-6 py-4">
                            <input
                                type="text"
                                wire:model="requirements.{{ $index }}.requirement_description"
                                placeholder="Short description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

                            @error("requirements.$index.requirement_description")
                            <p class="mt-1 text-xs text-rose-600 dark:text-rose-300">{{ $message }}</p>
                            @enderror
                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">
                            <button
                                type="button"
                                wire:click="removeRequirement({{ $index }})"
                                class="inline-flex items-center gap-1 text-xs font-medium text-rose-700 bg-rose-100 hover:bg-rose-200 px-2.5 py-1.5 rounded-lg transition-colors duration-150 dark:bg-rose-900 dark:text-rose-300 dark:hover:bg-rose-800">
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-10 h-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6M7.5 4.5h9A1.5 1.5 0 0118 6v12a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 016 18V6a1.5 1.5 0 011.5-1.5z" />
                                </svg>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    No requirements yet
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    Add the first training requirement for this course.
                                </p>

                                <button wire:click="addRequirement"
                                    class="mt-3 inline-flex items-center gap-2 text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition-colors duration-150">
                                    Add First Requirement
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="flex flex-col gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Review all entries before saving to avoid incomplete requirement details.
            </p>

            <button wire:click="save"
                class="inline-flex items-center justify-center gap-2 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors duration-150">
                Save Changes
            </button>
        </div>
    </div>
</div>