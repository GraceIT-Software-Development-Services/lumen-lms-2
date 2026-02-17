<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-5">
        <div class="flex flex-col gap-1.5">
            <h1 class="text-lg font-semibold text-gray-800 leading-snug">
                Create Student Batch Attendances
            </h1>

            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs font-medium text-blue-600 bg-blue-50 border border-blue-100 px-2.5 py-1 rounded-lg">
                    {{ $trainingBatch->batch_name }}
                </span>
                <span class="text-xs text-gray-400 font-mono bg-gray-100 px-2.5 py-1 rounded-lg">
                    {{ $trainingBatch->batch_code }}
                </span>
            </div>

            <p class="text-sm text-gray-400">Manage and monitor student attendance for training batches.</p>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('success'))
    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-8">
                        #
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Student Name
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Time In
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Time Out
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($trainingBatchStudent as $index => $batchStudent)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-400 text-xs font-mono">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-800">
                                {{ $batchStudent->full_name_searchable }}
                            </span>
                            <span class="text-xs text-gray-400">
                                Unique Learner Identifier: {{ $batchStudent->uli }}
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <input type="time"
                            wire:model="attendances.{{ $batchStudent->id }}.check_in_time"
                            class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition w-36">
                        @error("attendances.{$batchStudent->id}.check_in_time")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </td>
                    <td class="px-4 py-3">
                        <input type="time"
                            wire:model="attendances.{{ $batchStudent->id }}.check_out_time"
                            class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition w-36">
                        @error("attendances.{$batchStudent->id}.check_out_time")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end mt-4">
        <button wire:click="save" wire:confirm="Are you sure you want to save the attendances?"
            wire:loading.attr="disabled"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:opacity-60 text-white text-sm font-medium rounded-lg shadow-sm transition">
            <span wire:loading.remove wire:target="save">
                Save Attendances
            </span>
            <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                Saving...
            </span>
        </button>
    </div>
</div>