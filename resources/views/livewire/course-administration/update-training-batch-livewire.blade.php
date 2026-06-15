<div class="mx-auto max-w-full space-y-5">

    {{-- ===== MAIN CARD ===== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- ===== HEADER ===== --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            Update Training Batch
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Update course, schedule, trainer, capacity, and batch status.
                        </p>
                    </div>
                </div>

                <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                    Edit Batch
                </span>
            </div>
        </div>

        {{-- Livewire Loading Bar --}}
        <div
            wire:loading
            wire:target="trainingBatchCourseId,startDate,endDate,trainingBatchScheduleId,trainingBatchTrainerId,updateTrainingBatch,deleteTrainingBatch"
            class="h-1 w-full overflow-hidden bg-blue-50 dark:bg-blue-950/40">
            <div class="h-full w-1/3 animate-pulse rounded-r-full bg-blue-500"></div>
        </div>

        {{-- Error Message --}}
        @if(session('error'))
        <div class="m-5 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 shadow-sm dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-300">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm dark:bg-slate-900 dark:text-rose-300">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold">Error</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <form wire:submit.prevent="updateTrainingBatch">

            {{-- ===== BASIC INFORMATION ===== --}}
            <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                <div class="mb-5 flex items-start gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                        1
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Basic Information
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Training course, batch details, dates, and capacity.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div class="md:col-span-2">
                        <label for="training_course_id" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Training Course <span class="text-rose-500">*</span>
                        </label>

                        <select
                            id="training_course_id"
                            name="training_course_id"
                            wire:model.live="trainingBatchCourseId"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                            @error('trainingBatchCourseId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                            <option value="">Select training course</option>
                            @foreach($trainingCourses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>

                        @error('trainingBatchCourseId')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_code" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Batch Code <span class="text-rose-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="batch_code"
                            wire:model="batchCode"
                            value="{{ old('batchCode') }}"
                            placeholder="Enter batch code"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                            @error('batchCode') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                        @error('batchCode')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_name" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Batch Name <span class="text-rose-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="batch_name"
                            wire:model="batchName"
                            placeholder="Enter batch name"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                            @error('batchName') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                        @error('batchName')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Start Date <span class="text-rose-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="start_date"
                            wire:model.live="startDate"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                            @error('startDate') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                        @error('startDate')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            End Date <span class="text-rose-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="end_date"
                            wire:model.live="endDate"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                            @error('endDate') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                        @error('endDate')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_participants" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Max Participants <span class="text-rose-500">*</span>
                        </label>

                        <input
                            type="number"
                            id="max_participants"
                            wire:model="maxParticipants"
                            min="0"
                            placeholder="Enter max participants"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                            @error('maxParticipants') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                        @error('maxParticipants')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Status <span class="text-rose-500">*</span>
                        </label>

                        <select
                            id="status"
                            wire:model="batchStatus"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                            @error('batchStatus') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                            <option value="">Select status</option>
                            <option value="open">Open</option>
                            <option value="full">Full</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        @error('batchStatus')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- ===== SCHEDULE INFORMATION ===== --}}
            <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                <div class="mb-5 flex items-start gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-sm font-bold text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                        2
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Batch Schedule Information
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Assign a schedule template to this batch.
                        </p>
                    </div>
                </div>

                <label for="training_schedule_item_id" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                    Assigned Schedule <span class="text-rose-500">*</span>
                </label>

                <select
                    id="training_schedule_item_id"
                    wire:model.live="trainingBatchScheduleId"
                    class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                    @error('trainingBatchScheduleId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                    @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror">
                    <option value="">Select schedule</option>
                    @foreach($trainigScheduleItems as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->name }}
                        @if($schedule->schedule_days)
                        - {{ is_array($schedule->schedule_days) ? implode(', ', $schedule->schedule_days) : $schedule->schedule_days }}
                        @endif
                        @if($schedule->start_time && $schedule->end_time)
                        ({{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }})
                        @endif
                    </option>
                    @endforeach
                </select>

                @error('trainingBatchScheduleId')
                <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </section>

            {{-- ===== TRAINER INFORMATION ===== --}}
            <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                <div class="mb-5 flex items-start gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                        3
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Trainer Information
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Assign a trainer and review schedule conflicts.
                        </p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="trainer_id" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Assigned Trainer <span class="text-rose-500">*</span>
                        </label>

                        <select
                            id="trainer_id"
                            name="trainingBatchTrainerId"
                            wire:model.live="trainingBatchTrainerId"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                            @error('trainingBatchTrainerId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">
                            <option value="">Select trainer</option>
                            @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">
                                {{ $trainer->name }} {{ $trainer->last_name }} - Center: {{ $trainer->center_name }}
                            </option>
                            @endforeach
                        </select>

                        @error('trainingBatchTrainerId')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($trainingBatchTrainerId && count($trainerBatchList) > 0)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                                    Existing Batches
                                </p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Review trainer’s active schedule before saving.
                                </p>
                            </div>

                            @if(count($conflictingBatchIds) > 0)
                            <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                {{ count($conflictingBatchIds) }} conflict{{ count($conflictingBatchIds) > 1 ? 's' : '' }} detected
                            </span>
                            @else
                            <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                No conflicts
                            </span>
                            @endif
                        </div>

                        <div class="space-y-3">
                            @foreach($trainerBatchList as $batch)
                            @php
                            $isConflict = in_array($batch['id'], $conflictingBatchIds);
                            $days = is_array($batch['schedule_days'])
                            ? $batch['schedule_days']
                            : json_decode($batch['schedule_days'], true);
                            @endphp

                            <div class="rounded-2xl border p-4 transition
                                {{ $isConflict
                                    ? 'border-rose-200 bg-rose-50 dark:border-rose-900/50 dark:bg-rose-950/30'
                                    : 'border-emerald-100 bg-white dark:border-emerald-900/40 dark:bg-slate-900' }}">

                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full border
                                            {{ $isConflict ? 'border-rose-500 bg-rose-100 dark:bg-rose-950' : 'border-emerald-500 bg-emerald-100 dark:bg-emerald-950' }}">
                                            <span class="h-2 w-2 rounded-full {{ $isConflict ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold {{ $isConflict ? 'text-rose-800 dark:text-rose-200' : 'text-slate-800 dark:text-slate-100' }}">
                                                {{ $batch['batch_name'] }}
                                            </p>

                                            <p class="mt-0.5 font-mono text-xs {{ $isConflict ? 'text-rose-500 dark:text-rose-300' : 'text-slate-500 dark:text-slate-400' }}">
                                                {{ $batch['batch_code'] }}
                                            </p>

                                            <div class="mt-2 flex flex-wrap gap-x-3 gap-y-1 text-xs {{ $isConflict ? 'text-rose-500 dark:text-rose-300' : 'text-slate-500 dark:text-slate-400' }}">
                                                <span>
                                                    {{ \Carbon\Carbon::parse($batch['start_date'])->format('M d, Y') }}
                                                    –
                                                    {{ \Carbon\Carbon::parse($batch['end_date'])->format('M d, Y') }}
                                                </span>
                                                <span class="hidden text-slate-300 sm:inline">•</span>
                                                <span>
                                                    {{ \Carbon\Carbon::parse($batch['start_time'])->format('g:i A') }}
                                                    –
                                                    {{ \Carbon\Carbon::parse($batch['end_time'])->format('g:i A') }}
                                                </span>
                                                <span class="hidden text-slate-300 sm:inline">•</span>
                                                <span>{{ implode(', ', $days ?? []) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:text-right">
                                        @if($isConflict)
                                        <span class="inline-flex items-center rounded-full border border-rose-200 bg-white px-2.5 py-1 text-xs font-semibold text-rose-700 dark:border-rose-900/50 dark:bg-slate-900 dark:text-rose-300">
                                            Conflict
                                        </span>
                                        <p class="mt-1 text-xs text-rose-500 dark:text-rose-300">
                                            Overlapping schedule
                                        </p>
                                        @else
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300">
                                            Available
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($trainingBatchTrainerId && count($trainerBatchList) === 0)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300">
                            This trainer has no existing open batches.
                        </p>
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                            No schedule conflicts were found for this trainer.
                        </p>
                    </div>
                    @endif
                </div>
            </section>

            {{-- ===== ADDITIONAL INFORMATION ===== --}}
            <section class="px-5 py-6">
                <div class="mb-5 flex items-start gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-sm font-bold text-amber-600 dark:bg-amber-950/40 dark:text-amber-300">
                        4
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Additional Information
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Optional notes or comments for this batch.
                        </p>
                    </div>
                </div>

                <label for="notes" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                    Notes
                </label>

                <textarea
                    id="notes"
                    wire:model="notes"
                    rows="4"
                    placeholder="Enter any additional notes or comments"
                    class="block w-full resize-y rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                    @error('notes') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                    @else border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 dark:border-slate-700 @enderror">{{ old('notes') }}</textarea>

                @error('notes')
                <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </section>

            {{-- ===== FOOTER ===== --}}
            <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 lg:flex-row lg:items-center lg:justify-between">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Review all batch details carefully before saving or deleting.
                </p>

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('training_batches.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button
                        type="button"
                        wire:click="deleteTrainingBatch"
                        wire:confirm="Are you sure you want to delete this training batch?"
                        wire:loading.attr="disabled"
                        wire:target="deleteTrainingBatch"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-500/20 disabled:cursor-not-allowed disabled:opacity-70 dark:bg-rose-500 dark:hover:bg-rose-600">

                        <svg wire:loading.remove wire:target="deleteTrainingBatch" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                        <svg wire:loading wire:target="deleteTrainingBatch" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="deleteTrainingBatch">Delete Training Batch</span>
                        <span wire:loading wire:target="deleteTrainingBatch">Deleting...</span>
                    </button>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="updateTrainingBatch"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 disabled:cursor-not-allowed disabled:opacity-70 dark:bg-blue-500 dark:hover:bg-blue-600">

                        <svg wire:loading.remove wire:target="updateTrainingBatch" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>

                        <svg wire:loading wire:target="updateTrainingBatch" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="updateTrainingBatch">Update Training Batch</span>
                        <span wire:loading wire:target="updateTrainingBatch">Saving...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>