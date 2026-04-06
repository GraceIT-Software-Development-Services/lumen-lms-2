<div>
    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-5 mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Student Batch Attendances</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor student attendance for training batches</p>
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text"
                wire:model.live="search"
                placeholder="Search batch or schedule..."
                class="block pl-10 pr-4 py-2.5 text-sm text-gray-900 border border-gray-200 rounded-xl w-72 bg-gray-50 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
        </div>
    </div>

    {{-- ===== FLASH MESSAGES ===== --}}
    @if(session()->has('success'))
    <div class="mb-4 flex items-center gap-3 p-4 text-green-800 bg-green-50 rounded-xl border border-green-200">
        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="mb-4 flex items-center gap-3 p-4 text-red-800 bg-red-50 rounded-xl border border-red-200">
        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="text-sm font-medium">{{ session('error') }}</p>
    </div>
    @endif

    {{-- ===== CARDS ===== --}}
    <div class="space-y-4 ">
        @forelse($trainingBatches as $trainingBatch)
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden hover:shadow-md duration-200 transition transform hover:scale-[1.01]">

            {{-- Card Header --}}
            <div class="flex items-start justify-between px-6 py-4">
                <div class="flex items-start gap-4 flex-1 min-w-0">
                    {{-- Color dot / avatar --}}
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white truncate">
                                {{ $trainingBatch->batch_name }}
                            </h3>
                            <span class="inline-flex items-center px-2 py-0.5 text-xs font-mono font-medium text-blue-700 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-100 dark:border-blue-800 rounded-lg">
                                {{ $trainingBatch->batch_code }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 mt-1">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d, Y') }}
                            </span>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 7l5 5-5 5" />
                            </svg>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2 ml-4 shrink-0 flex-wrap justify-end">
                    <button
                        wire:click.prevent="completeTrainingBatch('{{ $trainingBatch->uuid }}')"
                        wire:confirm="Are you sure you want to mark this training batch as complete?"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40 border border-red-100 dark:border-red-800 rounded-lg transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-.723 3.066 3.745 3.745 0 01-3.066.723A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 01-3.066-.723 3.745 3.745 0 01-.723-3.066A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 01.723-3.066 3.745 3.745 0 013.066-.723A3.745 3.745 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 013.066.723 3.745 3.745 0 01.723 3.066A3.745 3.745 0 0121 12z" />
                        </svg>
                        Complete Training Batch
                    </button>

                    <a href="{{ route('training_student_batch_attendances.create', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-900/20 dark:text-indigo-400 dark:hover:bg-indigo-900/40 border border-indigo-100 dark:border-indigo-800 rounded-lg transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Attendance
                    </a>

                    <a href="{{ route('training_student_batch_attendances.report', ['trainingBatchUuid' => $trainingBatch->uuid]) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400 dark:hover:bg-emerald-900/40 border border-emerald-100 dark:border-emerald-800 rounded-lg transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Attendance Report
                    </a>

                    <span class="text-gray-300">|</span>

                    <a href="#" wire:confirm="Are you sure you want to proceed? This will lock the training course requirements and cannot be undone."
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40 border border-blue-100 dark:border-blue-800 rounded-lg transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        Training Course Requirements
                    </a>
                </div>
            </div>

            {{-- Info Strip --}}
            <div class="flex flex-wrap items-center gap-0 border-t border-gray-100 dark:border-gray-700 divide-x divide-gray-100 dark:divide-gray-700">

                {{-- Schedule Item --}}
                <div class="flex items-center gap-3 px-6 py-3 flex-1 min-w-[200px]">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.966 8.966 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Schedule Item</p>
                        <p class="text-xs font-semibold text-gray-700 dark:text-gray-200 truncate">{{ $trainingBatch->training_schedule_item_name }}</p>
                        @if($trainingBatch->training_schedule_item_description)
                        <p class="text-[10px] text-gray-400 truncate max-w-xs">{{ Str::limit($trainingBatch->training_schedule_item_description, 60) }}</p>
                        @endif
                    </div>
                </div>

                {{-- Time --}}
                <div class="flex items-center gap-3 px-6 py-3 flex-1 min-w-[160px]">
                    <div class="w-8 h-8 rounded-lg bg-teal-50 dark:bg-teal-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Time</p>
                        <div class="flex items-center gap-1 mt-0.5">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_start_time)->format('g:i A') }}
                            </span>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 7l5 5-5 5" />
                            </svg>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($trainingBatch->training_schedule_item_end_time)->format('g:i A') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Students --}}
                <div class="flex items-center gap-3 px-6 py-3 flex-1 min-w-[140px]">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 dark:bg-violet-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Students</p>
                        <p class="text-xs font-semibold text-gray-700 dark:text-gray-200 mt-0.5">
                            {{ $trainingBatch->registered_students_count }}
                            <span class="font-normal text-gray-400">enrolled</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>

        @empty
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-16 text-center">
            <div class="w-14 h-14 bg-gray-50 dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-gray-300 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">No training batches found</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Batches will appear here once created</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($trainingBatches, 'hasPages') && $trainingBatches->hasPages())
    <div class="mt-5 flex items-center justify-between">
        <p class="text-xs text-gray-400">
            Showing {{ $trainingBatches->firstItem() }} to {{ $trainingBatches->lastItem() }} of {{ $trainingBatches->total() }} batches
        </p>
        {{ $trainingBatches->links() }}
    </div>
    @endif
</div>