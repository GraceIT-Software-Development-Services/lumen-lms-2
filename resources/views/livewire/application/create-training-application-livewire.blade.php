<div class="mx-auto max-w-full space-y-5">

    {{-- Main Card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

        {{-- Header --}}
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                            New Training Application
                        </h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Apply for a training course at your preferred training center.
                        </p>
                    </div>
                </div>

                <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                    Application Form
                </span>
            </div>
        </div>

        <form wire:submit.prevent="save">

            {{-- Training Selection --}}
            <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800">
                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                        <span class="text-sm font-bold">1</span>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Training Selection
                        </h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Choose the course and available training center.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    {{-- Training Course --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Training Course <span class="text-rose-500">*</span>
                        </label>

                        <select
                            wire:model.live="training_course_id"
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition
                            @error('training_course_id')
                                border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else
                                border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700
                            @enderror
                            dark:bg-slate-800 dark:text-white dark:placeholder-slate-400">
                            <option value="">Select training course</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }} - {{ $course->course_code }}
                            </option>
                            @endforeach
                        </select>

                        @error('training_course_id')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Training Center --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            Training Center <span class="text-rose-500">*</span>
                        </label>

                        <select
                            wire:model.live="center_id"
                            @disabled(!$training_course_id)
                            class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition
                            @error('center_id')
                                border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else
                                border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700
                            @enderror
                            disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400 disabled:opacity-75
                            dark:bg-slate-800 dark:text-white dark:disabled:bg-slate-800/60 dark:disabled:text-slate-500">
                            <option value="">
                                {{ $training_course_id ? 'Select training center' : 'Select a course first' }}
                            </option>
                            @foreach ($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>

                        @error('center_id')
                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                        @enderror

                        @if(!$training_course_id)
                        <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">
                            Training centers will appear after selecting a course.
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800">
                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                        <span class="text-sm font-bold">2</span>
                    </div>
                    <div>
                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                            Additional Information
                        </h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Add remarks, questions, or special requests.
                        </p>
                    </div>
                </div>

                <div>
                    <label for="learner_remarks" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        Remarks / Notes <span class="font-normal normal-case text-slate-400">(Optional)</span>
                    </label>

                    <textarea
                        id="learner_remarks"
                        wire:model="learner_remarks"
                        rows="4"
                        maxlength="1000"
                        class="block w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-500 dark:disabled:bg-slate-800/60"
                        placeholder="Any additional information, questions, or special requests..."
                        @if($status && $status !=='pending' ) disabled @endif></textarea>

                    @error('learner_remarks')
                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror

                    <div class="mt-2 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            This helps the training center review your application properly.
                        </p>
                        <p class="text-xs font-medium text-slate-400 dark:text-slate-500">
                            {{ strlen($learner_remarks ?? '') }}/1000
                        </p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">
                <a
                    href="{{ route('learner-training-applications.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to List
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 disabled:cursor-not-allowed disabled:opacity-70 dark:bg-blue-500 dark:hover:bg-blue-600">

                    <svg wire:loading.remove wire:target="save" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>

                    <svg wire:loading wire:target="save" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>

                    <span wire:loading.remove wire:target="save">Submit Application</span>
                    <span wire:loading wire:target="save">Submitting...</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Guidelines --}}
    <div class="overflow-hidden rounded-2xl border border-blue-100 bg-blue-50/70 shadow-sm dark:border-blue-900/40 dark:bg-blue-950/20">
        <div class="flex items-start gap-3 p-5">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm dark:bg-slate-900 dark:text-blue-300">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>

            <div class="min-w-0">
                <h4 class="text-sm font-semibold text-blue-950 dark:text-blue-200">
                    Application Guidelines
                </h4>

                <ul class="mt-3 grid gap-2 text-xs text-blue-900 dark:text-blue-300 sm:grid-cols-2">
                    <li class="flex gap-2">
                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                        <span>Select a training course first before choosing a center.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                        <span>Only centers offering the selected course will be available.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                        <span>Your application will be reviewed by the center administrator.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                        <span>You will be notified once your application is processed.</span>
                    </li>
                    <li class="flex gap-2 sm:col-span-2">
                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                        <span>You can edit or cancel your application while it is still pending.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>