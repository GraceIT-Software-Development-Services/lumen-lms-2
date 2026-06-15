<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full space-y-5">

          {{-- ===== MAIN CARD ===== --}}
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

               {{-- ===== HEADER ===== --}}
               <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                         <div class="flex items-start gap-3">
                              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125 16.875 4.5M18 14.25v4.5A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6h4.5" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                                        Training Center Update
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Update center details, address, contact information, logo, and status.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              Edit Center
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

               {{-- ===== CURRENT CENTER SNAPSHOT ===== --}}
               @php
               $typeLabel = match($center->type) {
               'both' => 'Assessment & Training',
               'assessment_center' => 'Assessment Center',
               'training_center' => 'Training Center',
               default => $center->type ? ucwords(str_replace('_', ' ', $center->type)) : 'No type',
               };

               $statusClass = ($center->status ?? 'inactive') === 'active'
               ? 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-300'
               : 'border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-300';
               @endphp

               <div class="grid grid-cols-1 gap-4 p-5 lg:grid-cols-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60 lg:col-span-2">
                         <div class="flex items-start gap-4">
                              <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                                   @if($center->logo_path)
                                   <img
                                        src="{{ asset('storage/' . $center->logo_path) }}"
                                        alt="Center Logo"
                                        class="h-full w-full object-contain p-2">
                                   @else
                                   <span class="text-lg font-bold text-blue-700 dark:text-blue-300">
                                        {{ strtoupper(substr($center->name ?? 'C', 0, 1)) }}
                                   </span>
                                   @endif
                              </div>

                              <div class="min-w-0">
                                   <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Current Center
                                   </p>
                                   <h2 class="mt-1 truncate text-base font-semibold text-slate-950 dark:text-white">
                                        {{ $center->name }}
                                   </h2>
                                   <div class="mt-2 flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center rounded-full border border-blue-100 bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:border-blue-900/50 dark:bg-blue-950/30 dark:text-blue-300">
                                             {{ $center->code ?: 'No code' }}
                                        </span>

                                        <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">
                                             {{ ucfirst($center->status ?? 'inactive') }}
                                        </span>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="rounded-2xl border border-violet-200 bg-violet-50 p-4 dark:border-violet-900/50 dark:bg-violet-950/30">
                         <p class="text-xs font-semibold uppercase tracking-wide text-violet-700 dark:text-violet-300">
                              Center Type
                         </p>
                         <p class="mt-2 text-lg font-bold text-violet-800 dark:text-violet-200">
                              {{ $typeLabel }}
                         </p>
                         <p class="mt-1 text-xs text-violet-700/80 dark:text-violet-300/80">
                              Current assigned type
                         </p>
                    </div>

                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/30">
                         <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-300">
                              Contact
                         </p>
                         <p class="mt-2 text-lg font-bold text-emerald-800 dark:text-emerald-200">
                              {{ $center->contact_mobile ?: 'No mobile' }}
                         </p>
                         <p class="mt-1 text-xs text-emerald-700/80 dark:text-emerald-300/80">
                              Primary mobile number
                         </p>
                    </div>
               </div>

               <form id="update-center-form" action="{{ route('centers.update', $center->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ===== BASIC INFORMATION ===== --}}
                    <section class="border-t border-slate-100 px-5 py-6 dark:border-slate-800">
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
                                        value="{{ old('name', $center->name) }}"
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
                                        value="{{ old('short_name', $center->short_name) }}"
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
                                        value="{{ old('code', $center->code) }}"
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
                                        <option value="both" {{ old('type', $center->type) == 'both' ? 'selected' : '' }}>
                                             Assessment & Training
                                        </option>
                                        <option value="assessment_center" {{ old('type', $center->type) == 'assessment_center' ? 'selected' : '' }}>
                                             Assessment Center
                                        </option>
                                        <option value="training_center" {{ old('type', $center->type) == 'training_center' ? 'selected' : '' }}>
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
                                        <option value="active" {{ old('status', $center->status) == 'active' ? 'selected' : '' }}>
                                             Active
                                        </option>
                                        <option value="inactive" {{ old('status', $center->status) == 'inactive' ? 'selected' : '' }}>
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
                    <section class="border-t border-slate-100 px-5 py-6 dark:border-slate-800">
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
                            @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror">{{ old('address', $center->address) }}</textarea>

                              @error('address')
                              <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">
                                   {{ $message }}
                              </p>
                              @enderror
                         </div>
                    </section>

                    {{-- ===== CONTACT INFORMATION ===== --}}
                    <section class="border-t border-slate-100 px-5 py-6 dark:border-slate-800">
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
                                        value="{{ old('contact_mobile', $center->contact_mobile) }}"
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
                                        value="{{ old('contact_landline', $center->contact_landline) }}"
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
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75" />
                                             </svg>
                                        </div>

                                        <input
                                             type="email"
                                             id="email"
                                             name="email"
                                             value="{{ old('email', $center->email) }}"
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
                    <section class="border-t border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-sm font-bold text-amber-600 dark:bg-amber-950/40 dark:text-amber-300">
                                   4
                              </div>

                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Logo
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Current logo preview and optional replacement upload.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

                              {{-- Current Logo --}}
                              <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                                   <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Current Logo
                                   </p>

                                   <div class="flex h-32 items-center justify-center rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-900">
                                        @if($center->logo_path)
                                        <img
                                             src="{{ asset('storage/' . $center->logo_path) }}"
                                             alt="Center Logo"
                                             class="max-h-full max-w-full object-contain">
                                        @else
                                        <div class="text-center">
                                             <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">
                                                  <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5 12 3m0 0L7.5 7.5M12 3v13.5" />
                                                  </svg>
                                             </div>
                                             <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">
                                                  No logo uploaded
                                             </p>
                                        </div>
                                        @endif
                                   </div>
                              </div>

                              {{-- Upload New Logo --}}
                              <div class="lg:col-span-2 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800/60">
                                   <label for="logo" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-8 text-center transition hover:border-blue-300 hover:bg-blue-50/50 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-blue-800 dark:hover:bg-blue-950/20">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                             <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 7.5 12 3m0 0L7.5 7.5M12 3v13.5" />
                                             </svg>
                                        </div>

                                        <p class="mt-3 text-sm font-semibold text-slate-700 dark:text-slate-200">
                                             Click to upload new logo
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
                         </div>
                    </section>

                    {{-- ===== FOOTER ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 lg:flex-row lg:items-center lg:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Review all changes carefully before saving or deleting this center.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                              <a href="{{ route('centers.index') }}"
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
                                   Delete Center
                              </button>

                              <button
                                   type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update Center
                              </button>
                         </div>
                    </div>
               </form>

               <form id="delete-center-form" action="{{ route('centers.destroy', $center->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training center? This action cannot be undone.')) {
                    document.getElementById('delete-center-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>