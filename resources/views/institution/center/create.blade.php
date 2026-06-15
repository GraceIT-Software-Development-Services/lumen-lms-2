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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                                        Training Center Registration
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Register a new training center with contact details, address, and official logo.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              New Center
                         </span>
                    </div>
               </div>

               <form action="{{ route('centers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                        Primary center details and identification.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                              {{-- Center Name --}}
                              <div class="md:col-span-2">
                                   <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Center Name <span class="text-rose-500">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Enter center name"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('name') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('name')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Short Name --}}
                              <div>
                                   <label for="short_name" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Short Name
                                   </label>

                                   <input
                                        type="text"
                                        id="short_name"
                                        name="short_name"
                                        value="{{ old('short_name') }}"
                                        placeholder="Enter short name"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('short_name') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('short_name')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Center Code --}}
                              <div>
                                   <label for="code" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Center Code
                                   </label>

                                   <input
                                        type="text"
                                        id="code"
                                        name="code"
                                        value="{{ old('code') }}"
                                        placeholder="Enter center code"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('code') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">

                                   @error('code')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Center Type --}}
                              <div>
                                   <label for="type" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Center Type <span class="text-rose-500">*</span>
                                   </label>

                                   <select
                                        id="type"
                                        name="type"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800
                                @error('type') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select center type</option>
                                        <option value="both" {{ old('type', 'both') == 'both' ? 'selected' : '' }}>
                                             Assessment & Training
                                        </option>
                                        <option value="assessment_center" {{ old('type') == 'assessment_center' ? 'selected' : '' }}>
                                             Assessment Center
                                        </option>
                                        <option value="training_center" {{ old('type') == 'training_center' ? 'selected' : '' }}>
                                             Training Center
                                        </option>
                                   </select>

                                   @error('type')
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
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                             Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                             Inactive
                                        </option>
                                   </select>

                                   @error('status')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== LOCATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-sm font-bold text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                                   2
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Location
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Physical address and site location.
                                   </p>
                              </div>
                         </div>

                         <div>
                              <label for="address" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                   Complete Address
                              </label>

                              <textarea
                                   id="address"
                                   name="address"
                                   rows="4"
                                   placeholder="Enter complete address"
                                   class="block w-full resize-y rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                            @error('address') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                            @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror">{{ old('address') }}</textarea>

                              @error('address')
                              <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                   {{ $message }}
                              </p>
                              @enderror
                         </div>
                    </section>

                    {{-- ===== CONTACT INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                                   3
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Contact Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Phone numbers and email details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                              {{-- Mobile Number --}}
                              <div>
                                   <label for="contact_mobile" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Mobile Number
                                   </label>

                                   <input
                                        type="text"
                                        id="contact_mobile"
                                        name="contact_mobile"
                                        value="{{ old('contact_mobile') }}"
                                        placeholder="+63 9XX XXX XXXX"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('contact_mobile') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">

                                   @error('contact_mobile')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Landline Number --}}
                              <div>
                                   <label for="contact_landline" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Landline Number
                                   </label>

                                   <input
                                        type="text"
                                        id="contact_landline"
                                        name="contact_landline"
                                        value="{{ old('contact_landline') }}"
                                        placeholder="(02) XXXX XXXX"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('contact_landline') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">

                                   @error('contact_landline')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>

                              {{-- Email Address --}}
                              <div class="md:col-span-2">
                                   <label for="email" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Email Address
                                   </label>

                                   <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                             <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                                             </svg>
                                        </div>

                                        <input
                                             type="email"
                                             id="email"
                                             name="email"
                                             value="{{ old('email') }}"
                                             placeholder="center@example.com"
                                             class="block w-full rounded-xl border bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                    @error('email') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                    @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">
                                   </div>

                                   @error('email')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                        {{ $message }}
                                   </p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== LOGO ===== --}}
                    <section class="px-5 py-6">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-sm font-bold text-amber-600 dark:bg-amber-950/40 dark:text-amber-300">
                                   4
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Logo
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Upload the official training center logo.
                                   </p>
                              </div>
                         </div>

                         <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800/60">
                              <label for="logo" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-8 text-center transition hover:border-blue-300 hover:bg-blue-50/50 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-blue-800 dark:hover:bg-blue-950/20">
                                   <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5L12 3m0 0L7.5 7.5M12 3v13.5" />
                                        </svg>
                                   </div>

                                   <p class="mt-3 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                        Click to upload center logo
                                   </p>
                                   <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        PNG, JPG, or JPEG only. Maximum file size: 2MB.
                                   </p>

                                   <input
                                        id="logo"
                                        name="logo_path"
                                        type="file"
                                        accept="image/*"
                                        class="sr-only">
                              </label>

                              @error('logo_path')
                              <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                   {{ $message }}
                              </p>
                              @enderror
                         </div>
                    </section>

                    {{-- ===== FOOTER ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Required fields are marked with <span class="font-semibold text-rose-500">*</span>.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                              <a href="{{ route('centers.index') }}"
                                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                   Cancel
                              </a>

                              <button
                                   type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                                   </svg>
                                   Register Center
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>