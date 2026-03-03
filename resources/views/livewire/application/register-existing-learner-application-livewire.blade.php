<div>

    <div class="max-w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Enroll Learner - ({{ $firstName . ' ' . $lastName }})
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Choose a training course, center, and batch to enroll this learner.
                    </p>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session()->has('success'))
            <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form wire:submit.prevent="save">

                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Training Course and Batch Assignment</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Training Course --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Training Course <span class="text-red-500">*</span>
                            </label>
                            <select
                                wire:model.live="courseId"
                                class="bg-gray-50 border @error('courseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">Select training course</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }} - {{ $course->course_code }}</option>
                                @endforeach
                            </select>
                            @error('courseId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Center Selection --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Training Center <span class="text-red-500">*</span>
                            </label>
                            <select
                                wire:model.live="centerId"
                                @disabled(!$courseId)
                                class="bg-gray-50 border @error('centerId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white disabled:opacity-50 disabled:cursor-not-allowed">
                                <option value="">{{ $courseId ? 'Select training center' : 'Select a course first' }}</option>
                                @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                @endforeach
                            </select>
                            @error('centerId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Training Batch --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Student Training Batch <span class="text-red-500">*</span>
                            </label>
                            <select
                                wire:model.live="batchId"
                                @disabled(!$centerId)
                                class="bg-gray-50 border @error('batchId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white disabled:opacity-50 disabled:cursor-not-allowed">
                                <option value="">{{ $centerId ? '— Select a training batch —' : 'Select a center first' }}</option>
                                @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->batch_name }}
                                    • {{ $batch->batch_code }}
                                    • ({{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                    – {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }})
                                </option>
                                @endforeach
                            </select>
                            @error('batchId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register application
                    </button>

                    <a
                        href="{{ route('learner-training-applications.list.registered.applicants') }}"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                        <svg class="w-4 h-4 inline mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>