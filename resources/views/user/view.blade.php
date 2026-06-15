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
                                        User Update
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Update user role, center assignment, and access details.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              Edit User
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

               <form id="update-user-form" action="{{ route('users-update.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- ===== USER INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-sm font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                   1
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        User Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Current user account information.
                                   </p>
                              </div>
                         </div>

                         <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                              <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                   <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 dark:border-blue-900/50 dark:bg-blue-950/40">
                                        <span class="text-lg font-bold text-blue-700 dark:text-blue-300">
                                             {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                        </span>
                                   </div>

                                   <div class="min-w-0 flex-1">
                                        <p class="truncate text-base font-semibold text-slate-950 dark:text-white">
                                             {{ $user->name }}
                                        </p>

                                        <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500 dark:text-slate-400">
                                             <span class="inline-flex items-center gap-1.5">
                                                  <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75" />
                                                  </svg>
                                                  {{ $user->email }}
                                             </span>

                                             <span class="inline-flex items-center gap-1.5">
                                                  <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15A2.25 2.25 0 0021.75 17.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5z" />
                                                  </svg>
                                                  ID #{{ $user->id }}
                                             </span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </section>

                    {{-- ===== ASSIGNMENT INFORMATION ===== --}}
                    <section class="px-5 py-6">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                                   2
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Assignment Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Update the assigned role and training center.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                              {{-- Role --}}
                              <div>
                                   <label for="role" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Role <span class="text-rose-500">*</span>
                                   </label>

                                   <select
                                        id="role"
                                        name="role"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('role') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Choose role</option>

                                        @foreach ($rolelists as $role)
                                        <option value="{{ $role->name }}" {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                             {{ $role->name }}
                                        </option>
                                        @endforeach
                                   </select>

                                   @error('role')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Center --}}
                              <div>
                                   <label for="center_id" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Center <span class="text-rose-500">*</span>
                                   </label>

                                   <select
                                        id="center_id"
                                        name="center_id"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('center_id') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select a center</option>

                                        @foreach($centers as $center)
                                        <option value="{{ $center->id }}" {{ old('center_id', $user->center_id) == $center->id ? 'selected' : '' }}>
                                             {{ $center->code }} - {{ $center->name }}
                                        </option>
                                        @endforeach
                                   </select>

                                   @error('center_id')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== FORM ACTIONS ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 lg:flex-row lg:items-center lg:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Review the assigned role and center before saving changes.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">

                              <a href="{{ route('users.index') }}"
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
                                   Delete User
                              </button>

                              <button
                                   type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update User
                              </button>
                         </div>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-user-form" action="{{ route('users-delete.delete', $user->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     {{-- Delete Confirmation Script --}}
     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                    document.getElementById('delete-user-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>