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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5M18 14.25v4.5A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6h4.5" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                                        Course Update
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Update course details, TESDA information, and center assignments.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              Edit Course
                         </span>
                    </div>
               </div>

               {{-- ===== SUCCESS MESSAGE ===== --}}
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

               <form id="update-course-form" action="{{ route('training_courses.update', $course->uuid) }}" method="POST" enctype="multipart/form-data">
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
                                        Primary course details, status, duration, and description.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                              {{-- Course Code --}}
                              <div>
                                   <label for="course_code" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Course Code <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="course_code"
                                        name="course_code"
                                        value="{{ old('course_code', $course->course_code) }}"
                                        placeholder="Enter course code"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('course_code') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('course_code')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Status --}}
                              <div>
                                   <label for="status" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Status
                                   </label>

                                   <select
                                        id="status"
                                        name="status"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('status') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                                        <option value="Active" {{ old('status', $course->status) == 'Active' ? 'selected' : '' }}>
                                             Active
                                        </option>
                                        <option value="Inactive" {{ old('status', $course->status) == 'Inactive' ? 'selected' : '' }}>
                                             Inactive
                                        </option>
                                   </select>

                                   @error('status')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Course Name --}}
                              <div class="md:col-span-2">
                                   <label for="course_name" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Course Name <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="course_name"
                                        name="course_name"
                                        value="{{ old('course_name', $course->course_name) }}"
                                        placeholder="Enter course name"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('course_name') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('course_name')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Description --}}
                              <div class="md:col-span-2">
                                   <label for="description" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Description
                                   </label>

                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        placeholder="Enter course description"
                                        class="block w-full resize-y rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('description') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">{{ old('description', $course->description) }}</textarea>

                                   @error('description')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Duration --}}
                              <div>
                                   <label for="duration_hours" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Duration Hours
                                   </label>

                                   <div class="relative">
                                        <input
                                             type="number"
                                             id="duration_hours"
                                             name="duration_hours"
                                             value="{{ old('duration_hours', $course->duration_hours) }}"
                                             min="0"
                                             placeholder="Enter duration in hours"
                                             class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 pr-14 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                    @error('duration_hours') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                    @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-xs font-semibold text-slate-400">
                                             hrs
                                        </span>
                                   </div>

                                   @error('duration_hours')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== TESDA INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-sm font-bold text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                                   2
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        TESDA Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Course accreditation and training regulation details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                              {{-- TESDA Checkbox --}}
                              <div class="md:col-span-2">
                                   <label for="is_tesda_course" class="flex cursor-pointer items-start gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 p-4 transition hover:border-emerald-300 dark:border-emerald-900/50 dark:bg-emerald-950/20 dark:hover:border-emerald-700">
                                        <input type="hidden" name="is_tesda_course" value="0">

                                        <input
                                             id="is_tesda_course"
                                             name="is_tesda_course"
                                             type="checkbox"
                                             value="1"
                                             {{ old('is_tesda_course', $course->is_tesda_course) == '1' ? 'checked' : '' }}
                                             class="mt-0.5 h-4 w-4 rounded border-emerald-300 text-emerald-600 focus:ring-emerald-500 dark:border-emerald-700 dark:bg-slate-900">

                                        <div>
                                             <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-300">
                                                  TESDA Accredited Course
                                             </p>
                                             <p class="mt-0.5 text-xs text-emerald-700/80 dark:text-emerald-300/80">
                                                  Mark this if the course has official TESDA accreditation.
                                             </p>
                                        </div>
                                   </label>

                                   @error('is_tesda_course')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- TR Number --}}
                              <div class="md:col-span-2" id="tr_number_container">
                                   <label for="tr_number" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Training Regulation Number
                                        <span class="text-rose-500" id="tr_required_indicator" style="display: none;">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="tr_number"
                                        name="tr_number"
                                        value="{{ old('tr_number', $course->tr_number) }}"
                                        placeholder="Enter TR number"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('tr_number') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror">

                                   <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                        Required only when this course is marked as TESDA accredited.
                                   </p>

                                   @error('tr_number')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== CENTER ASSIGNMENT ===== --}}
                    <section class="px-5 py-6">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                                   3
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Center Assignment
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Assign this course to one or more training centers.
                                   </p>
                              </div>
                         </div>

                         <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                              <label for="course_center_id" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                   Select Center <span class="text-rose-500">*</span>
                              </label>

                              <select
                                   id="course_center_id"
                                   name="course_center_id[]"
                                   multiple
                                   class="block min-h-40 w-full rounded-xl border bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:bg-slate-900 dark:text-white
                            @error('course_center_id') border-rose-300 focus:border-rose-500 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 dark:border-slate-700 @enderror">

                                   @foreach($courseCenters as $center)
                                   <option value="{{ $center->id }}"
                                        {{ in_array($center->id, old('course_center_id', $selectedCenterIds)) ? 'selected' : '' }}>
                                        {{ $center->name }}
                                   </option>
                                   @endforeach
                              </select>

                              <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                   Hold Ctrl on Windows or Command on Mac to select multiple centers.
                              </p>

                              @error('course_center_id')
                              <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                   {{ $message }}
                              </p>
                              @enderror
                         </div>
                    </section>

                    {{-- ===== FOOTER ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 lg:flex-row lg:items-center lg:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Review all changes carefully before saving or deleting this course.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                              <a href="{{ route('training_courses.index') }}"
                                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                   Cancel
                              </a>

                              <button
                                   type="button"
                                   onclick="confirmDelete()"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-500/20 dark:bg-rose-500 dark:hover:bg-rose-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                   </svg>
                                   Delete Course
                              </button>

                              <button
                                   type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update Course
                              </button>
                         </div>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-course-form" action="{{ route('training_courses.destroy', $course->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               const tesdaCheckbox = document.getElementById('is_tesda_course');
               const trNumberInput = document.getElementById('tr_number');
               const trRequiredIndicator = document.getElementById('tr_required_indicator');

               function toggleTRNumber() {
                    if (tesdaCheckbox.checked) {
                         trRequiredIndicator.style.display = 'inline';
                         trNumberInput.parentElement.classList.add('opacity-100');
                    } else {
                         trRequiredIndicator.style.display = 'none';
                         trNumberInput.parentElement.classList.remove('opacity-100');
                    }
               }

               tesdaCheckbox.addEventListener('change', toggleTRNumber);
               toggleTRNumber();
          });

          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training course? This action cannot be undone.')) {
                    document.getElementById('delete-course-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>