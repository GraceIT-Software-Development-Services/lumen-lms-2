<div>
    <div class="max-w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Register Training Batch
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Fill the details of the training batch
                    </p>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
            @endif

            {{-- Basic Information --}}
            <div class="p-4 md:p-5 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Training Course --}}
                    <div class="md:col-span-2">
                        <label for="training_course_id" class="block mb-2 text-sm font-medium text-gray-900">
                            Training Course <span class="text-red-600">*</span>
                        </label>
                        <select
                            id="training_course_id"
                            name="training_course_id"
                            wire:model.live="trainingBatchCourseId"
                            class="bg-gray-50 border @error('trainingBatchCourseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select training course</option>
                            @foreach($trainingCourses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('trainingBatchCourseId')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Batch Code --}}
                    <div>
                        <label for="batch_code" class="block mb-2 text-sm font-medium text-gray-900">
                            Batch Code <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="batch_code"
                            wire:model="batchCode"
                            value="{{ old('batchCode') }}"
                            class="bg-gray-50 border @error('batch_code') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter batch code">
                        @error('batchCode')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Batch Name --}}
                    <div>
                        <label for="batch_name" class="block mb-2 text-sm font-medium text-gray-900">
                            Batch Name <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="batch_name"
                            wire:model="batchName"
                            class="bg-gray-50 border @error('batch_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter batch name">
                        @error('batchName')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">
                            Start Date <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="date"
                            id="start_date"
                            wire:model.live="startDate"
                            class="bg-gray-50 border @error('start_date') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('startDate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">
                            End Date <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="date"
                            id="end_date"
                            wire:model.live="endDate"
                            class="bg-gray-50 border @error('endDate') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('endDate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Max Participants --}}
                    <div>
                        <label for="max_participants" class="block mb-2 text-sm font-medium text-gray-900">
                            Max Participants <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="number"
                            id="max_participants"
                            wire:model="maxParticipants"
                            min="0"
                            class="bg-gray-50 border @error('maxParticipants') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter max participants">
                        @error('maxParticipants')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                            Status <span class="text-red-600">*</span>
                        </label>
                        <select
                            id="status"
                            wire:model="batchStatus"
                            class="bg-gray-50 border @error('batchStatus') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select status</option>
                            <option value="open">Open</option>
                            <option value="full">Full</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('batchStatus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="p-4 md:p-5 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Batch Schedule Information</h2>
                <div>
                    <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900">
                        Assigned Schedule
                    </label>
                    <select
                        id="training_schedule_item_id"
                        wire:model.live="trainingBatchScheduleId"
                        class="bg-gray-50 border @error('training_schedule_item_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Trainer Information --}}
            <div class="p-4 md:p-5 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Trainer Information</h2>
                <div>
                    <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900">
                        Assigned Trainer
                    </label>
                    <select
                        id="trainer_id"
                        name="trainingBatchTrainerId"
                        wire:model.live="trainingBatchTrainerId"
                        class="bg-gray-50 border @error('trainingBatchTrainerId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Select trainer (optional)</option>
                        @foreach($trainers as $trainer)
                        <option value="{{ $trainer->id }}">
                            {{ $trainer->name }} {{ $trainer->last_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('trainingBatchTrainerId')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Existing Batches of Selected Trainer --}}
                @if($trainingBatchTrainerId && count($trainerBatchList) > 0)
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Existing Batches
                        @if(count($conflictingBatchIds) > 0)
                        <span class="ml-2 text-xs font-normal text-red-500">
                            ⚠ {{ count($conflictingBatchIds) }} conflict{{ count($conflictingBatchIds) > 1 ? 's' : '' }} detected
                        </span>
                        @endif
                    </label>

                    <div class="space-y-2">
                        @foreach($trainerBatchList as $batch)
                        @php
                        $isConflict = in_array($batch['id'], $conflictingBatchIds);
                        $days = is_array($batch['schedule_days'])
                        ? $batch['schedule_days']
                        : json_decode($batch['schedule_days'], true);
                        @endphp

                        <div class="flex items-center justify-between rounded-lg border px-4 py-3 transition-colors
                        {{ $isConflict ? 'border-red-300 bg-red-50' : 'border-gray-200 bg-gray-50' }}">

                            {{-- Left: Dot + Info --}}
                            <div class="flex items-center gap-3">

                                {{-- Status dot --}}
                                <div class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full border-2
                                {{ $isConflict ? 'border-red-500' : 'border-indigo-500' }}">
                                    <div class="h-2 w-2 rounded-full {{ $isConflict ? 'bg-red-500' : 'bg-indigo-500' }}">
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold {{ $isConflict ? 'text-red-700' : 'text-gray-800' }}">
                                        {{ $batch['batch_name'] }}
                                    </p>
                                    <p class="text-xs {{ $isConflict ? 'text-red-500' : 'text-gray-500' }}">
                                        {{ $batch['batch_code'] }}
                                    </p>
                                    <p class="text-xs {{ $isConflict ? 'text-red-400' : 'text-gray-400' }}">
                                        {{ \Carbon\Carbon::parse($batch['start_date'])->format('M d, Y') }}
                                        –
                                        {{ \Carbon\Carbon::parse($batch['end_date'])->format('M d, Y') }}
                                    </p>

                                    {{-- Show schedule details always --}}
                                    <p class="mt-0.5 text-xs {{ $isConflict ? 'text-red-400' : 'text-gray-400' }}">
                                        🕐 {{ \Carbon\Carbon::parse($batch['start_time'])->format('g:i A') }}
                                        – {{ \Carbon\Carbon::parse($batch['end_time'])->format('g:i A') }}
                                        &nbsp;|&nbsp;
                                        {{ implode(', ', $days ?? []) }}
                                    </p>
                                </div>
                            </div>

                            {{-- Right: Badge --}}
                            <div class="flex flex-col items-end gap-1">
                                @if($isConflict)
                                <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-600">
                                    Conflict
                                </span>
                                <span class="text-xs text-red-400">⚠ Overlapping schedule</span>
                                @else
                                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-600">
                                    {{ ucfirst($batch['status']) }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @elseif($trainingBatchTrainerId && count($trainerBatchList) === 0)
                <p class="text-sm text-gray-400 italic">This trainer has no existing open batches.</p>
                @endif
            </div>

            {{-- Additional Information --}}
            <div class="p-4 md:p-5 space-y-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h2>
                <div>
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">
                        Notes
                    </label>
                    <textarea
                        id="notes"
                        wire:model="notes"
                        rows="4"
                        class="bg-gray-50 border @error('notes') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Enter any additional notes or comments">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button
                    wire:click="saveTrainingBatch"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Register Training Batch
                </button>

                <a href="{{ route('training_batches.index') }}"
                    class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>