<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full space-y-5">

          {{-- ===== MAIN CARD ===== --}}
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

               {{-- ===== HEADER ===== --}}
               <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                         <div class="flex items-start gap-3">
                              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                                        Training Schedule Item Update
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Update schedule name, active days, and session time.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              Edit Schedule
                         </span>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
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

               <form id="update-schedule-item-form" action="{{ route('training_schedule_items.update', $trainingScheduleItem->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                        Schedule name and description details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div class="md:col-span-2">
                                   <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Schedule Name <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $trainingScheduleItem->name) }}"
                                        placeholder="e.g. Morning Training Session"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('name') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('name')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label for="description" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Description
                                   </label>

                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="3"
                                        placeholder="Optional description"
                                        class="block w-full resize-y rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('description') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">{{ old('description', $trainingScheduleItem->description) }}</textarea>

                                   @error('description')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== SCHEDULE DAYS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-sm font-bold text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                                   2
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Schedule Days
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Choose the active days for this schedule.
                                   </p>
                              </div>
                         </div>

                         @php
                         $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                         $oldDays = old('schedule_days', $trainingScheduleItem->schedule_days ?? []);
                         @endphp

                         <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                              <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                                   @foreach ($days as $day)
                                   <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 transition hover:border-emerald-300 hover:bg-emerald-50 has-[:checked]:border-emerald-400 has-[:checked]:bg-emerald-50 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-emerald-800 dark:hover:bg-emerald-950/20 dark:has-[:checked]:border-emerald-700 dark:has-[:checked]:bg-emerald-950/30">
                                        <input
                                             type="checkbox"
                                             name="schedule_days[]"
                                             value="{{ $day }}"
                                             {{ in_array($day, $oldDays) ? 'checked' : '' }}
                                             class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 dark:border-slate-600 dark:bg-slate-800">

                                        <div>
                                             <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                  {{ $day }}
                                             </p>
                                             <p class="text-xs text-slate-400 dark:text-slate-500">
                                                  {{ strtoupper(substr($day, 0, 3)) }}
                                             </p>
                                        </div>
                                   </label>
                                   @endforeach
                              </div>

                              @error('schedule_days')
                              <p class="mt-3 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                              @enderror
                         </div>
                    </section>

                    {{-- ===== SESSION TIME ===== --}}
                    <section class="px-5 py-6">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                                   3
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Session Time
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Set the start and end time of the session.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label for="start_time" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Start Time <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="time"
                                        id="start_time"
                                        name="start_time"
                                        value="{{ old('start_time', date('H:i', strtotime($trainingScheduleItem->start_time))) }}"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('start_time') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">

                                   @error('start_time')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="end_time" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        End Time <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="time"
                                        id="end_time"
                                        name="end_time"
                                        value="{{ old('end_time', date('H:i', strtotime($trainingScheduleItem->end_time))) }}"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('end_time') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">

                                   @error('end_time')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== FOOTER ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 lg:flex-row lg:items-center lg:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Review all schedule details carefully before saving or deleting.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                              <a href="{{ route('training_schedule_items.index') }}"
                                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                   Cancel
                              </a>

                              <button
                                   type="button"
                                   onclick="confirmDelete()"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-500/20 dark:bg-rose-500 dark:hover:bg-rose-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                   </svg>
                                   Delete Schedule
                              </button>

                              <button
                                   type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update Schedule
                              </button>
                         </div>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-schedule-item-form" action="{{ route('training_schedule_items.destroy', $trainingScheduleItem->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training schedule item? This action cannot be undone.')) {
                    document.getElementById('delete-schedule-item-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>