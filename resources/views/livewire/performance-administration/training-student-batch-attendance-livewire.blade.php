<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Student Batch Attendances</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor student attendance for training batches</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search attendance..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900 dark:text-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Batch Details</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule Details</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"># of Student</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainingBatches as $trainingBatch)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <!-- Iteration Number -->
                        <td class="px-5 py-3.5 text-gray-400 font-medium">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Batch Information -->
                        <td class="px-5 py-3.5">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-gray-900">{{ $trainingBatch->batch_name }}</span>
                                    <span class="px-2 py-0.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                        {{ $trainingBatch->batch_code }}
                                    </span>
                                    <span class="px-2 py-0.5 text-md font-medium text-gray-700">
                                        ({{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }})
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Schedule Item Details -->
                        <td class="px-5 py-3.5">
                            <div class="space-y-2">
                                <div class="font-semibold text-gray-900">
                                    {{ $trainingBatch->training_schedule_item_name }}
                                </div>
                                @if($trainingBatch->training_schedule_item_description)
                                <div class="text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit($trainingBatch->training_schedule_item_description, 100) }}
                                </div>
                                @endif
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="flex items-center gap-1 text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_start_time)->format('g:i A') }}
                                    </span>
                                    <span class="text-gray-400">-</span>
                                    <span class="text-gray-600">
                                        {{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_end_time)->format('g:i A') }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Session Title -->
                        <td class="px-5 py-3.5">
                            <div class="font-medium text-gray-900">
                                {{ $trainingBatch->registered_students_count }}
                            </div>
                        </td>

                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('training_student_batch_attendances.create', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                                    class="inline-flex items-center gap-1.5 text-indigo-500 hover:text-indigo-700 font-medium text-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Attendance
                                </a>

                                <span class="text-gray-300">|</span>

                                <a href="{{ route('training_student_batch_attendances.report', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                                    class="inline-flex items-center gap-1.5 text-emerald-500 hover:text-emerald-700 font-medium text-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Attendance Report
                                </a>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-4 text-center">
                            <svg class="mx-auto w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">No student batch attendances found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($trainingBatches->hasPages())
    <div class="mt-4">
        {{ $trainingBatches->links() }}
    </div>
    @endif
</div>