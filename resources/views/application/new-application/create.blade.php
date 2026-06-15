<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full space-y-5">

          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">

               {{-- ===== HEADER ===== --}}
               <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-5 py-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                         <div class="flex items-start gap-3">
                              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-5.25a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM3.75 20.25a7.5 7.5 0 0115 0" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-slate-950 dark:text-white">
                                        New Learner Registration
                                   </h1>
                                   <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                        Complete learner profile, personal details, documents, and training assignment.
                                   </p>
                              </div>
                         </div>

                         <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-100 bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm dark:border-blue-900/50 dark:bg-slate-900 dark:text-blue-300">
                              <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                              New Application
                         </span>
                    </div>
               </div>

               {{-- ===== FLASH MESSAGES ===== --}}
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

               @if(session('error'))
               <div class="m-5 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 shadow-sm dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-300">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm dark:bg-slate-900 dark:text-rose-300">
                         <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                         </svg>
                    </div>
                    <div>
                         <p class="text-sm font-semibold">Error</p>
                         <p class="text-sm">{{ session('error') }}</p>
                    </div>
               </div>
               @endif

               <form action="{{ route('learner-applications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- ===== ULI ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="uli">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                   1
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Unique Learner Identifier
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Enter the learner’s official unique learner identifier.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Unique Learner Identifier <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="text" name="uli" value="{{ old('uli') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('uli') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror"
                                        placeholder="Enter ULI">
                                   @error('uli')
                                   <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== OTHER INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-sm font-bold text-indigo-600 dark:bg-indigo-950/40 dark:text-indigo-300">
                                   2
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Other Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Select client type and upload profile picture.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Client Type
                                   </label>
                                   <select name="clientType"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:bg-slate-800">
                                        <option value="">Select client type</option>
                                        <option value="Industry Worker" @selected(old('clientType')==='Industry Worker' )>Industry Worker</option>
                                        <option value="Student" @selected(old('clientType')==='Student' )>Student</option>
                                        <!-- <option value="Cooperative" @selected(old('clientType')==='Cooperative' )>Cooperative</option>
                                        <option value="Association" @selected(old('clientType')==='Association' )>Association</option> -->
                                        <option value="Graduate" @selected(old('clientType')==='Graduate' )>Graduate</option>
                                   </select>
                              </div>

                              <div class="md:col-span-2">
                                   <label for="picture" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Profile Picture
                                   </label>

                                   <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                                        <input type="file" id="picture" name="picture" accept="image/*"
                                             class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                             onchange="previewPicture(this)">

                                        <div id="picture-preview" class="mt-4 hidden">
                                             <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 dark:border-slate-700 dark:bg-slate-900">
                                                  <img id="picture-preview-img" src="" class="h-20 w-20 rounded-xl border border-slate-200 object-cover dark:border-slate-700">
                                                  <div>
                                                       <p class="text-sm font-semibold text-slate-900 dark:text-white">New photo selected</p>
                                                       <p class="text-xs text-slate-500 dark:text-slate-400">Preview of uploaded profile picture.</p>
                                                  </div>
                                             </div>
                                        </div>

                                        @error('picture')
                                        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                    </section>

                    {{-- ===== BASIC INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="basic">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-sm font-bold text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-300">
                                   3
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Basic Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Learner’s legal name and suffix.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        First Name <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="text" name="firstName" value="{{ old('firstName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-800
                                @error('firstName') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror"
                                        placeholder="Enter first name">
                                   @error('firstName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Middle Name
                                   </label>
                                   <input type="text" name="middleName" value="{{ old('middleName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Enter middle name">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Last Name <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="text" name="lastName" value="{{ old('lastName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500
                                @error('lastName') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 @enderror"
                                        placeholder="Enter last name">
                                   @error('lastName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Suffix
                                   </label>
                                   <input type="text" name="suffix" value="{{ old('suffix') }}" maxlength="10" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Jr., Sr., III">
                              </div>
                         </div>
                    </section>

                    {{-- ===== ASSOCIATION INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="association">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-sm font-bold text-violet-600 dark:bg-violet-950/40 dark:text-violet-300">
                                   4
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Association Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        For cooperative or association type applicants.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Association
                                   </label>
                                   <select name="association" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white
                                @error('association') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select Association</option>
                                        @foreach($associations as $association)
                                        <option value="{{ $association->id }}" {{ old('association') == $association->id ? 'selected' : '' }}>
                                             {{ $association->name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('association')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== SCHOOL INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="school">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-sm font-bold text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-300">
                                   5
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        School Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        School name and address details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        School Name
                                   </label>
                                   <input type="text" name="schoolName" value="{{ old('schoolName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="e.g. XYZ Technical School">
                                   @error('schoolName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        School Address
                                   </label>
                                   <textarea name="schoolAddress" rows="1" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Complete school address">{{ old('schoolAddress') }}</textarea>
                                   @error('schoolAddress')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== PERSONAL INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="personal">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-sm font-bold text-rose-600 dark:bg-rose-950/40 dark:text-rose-300">
                                   6
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Personal Information
                                   </h2>
                                   <p class="mt-1 inline-flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                             <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                        Personal information is encrypted and stored securely.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Sex <span class="text-rose-500">*</span>
                                   </label>
                                   <select name="sex"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white
                                @error('sex') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select sex</option>
                                        <option value="male" @selected(old('sex')==='male' )>Male</option>
                                        <option value="female" @selected(old('sex')==='female' )>Female</option>
                                   </select>
                                   @error('sex')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Civil Status <span class="text-rose-500">*</span>
                                   </label>
                                   <select name="civilStatus"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white
                                @error('civilStatus') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select civil status</option>
                                        <option value="single" @selected(old('civilStatus')==='single' )>Single</option>
                                        <option value="married" @selected(old('civilStatus')==='married' )>Married</option>
                                        <option value="widow" @selected(old('civilStatus')==='widow' )>Widow</option>
                                        <option value="separated" @selected(old('civilStatus')==='separated' )>Separated</option>
                                   </select>
                                   @error('civilStatus')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Date of Birth <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="date" name="birthDate" value="{{ old('birthDate') }}"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white
                                @error('birthDate') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 @enderror">
                                   @error('birthDate')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Place of Birth
                                   </label>
                                   <input type="text" name="birthPlace" value="{{ old('birthPlace') }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="City/Municipality, Province">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Mother's Name
                                   </label>
                                   <input type="text" name="motherName" value="{{ old('motherName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Full name">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Father's Name
                                   </label>
                                   <input type="text" name="fatherName" value="{{ old('fatherName') }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-rose-500 focus:bg-white focus:ring-4 focus:ring-rose-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Full name">
                              </div>
                         </div>
                    </section>

                    {{-- ===== ADDRESS INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="address">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-sm font-bold text-orange-600 dark:bg-orange-950/40 dark:text-orange-300">
                                   7
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Address Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Complete residential address details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              <div class="md:col-span-3">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        House/Block/Lot No., Street
                                   </label>
                                   <input type="text" name="addressNumberStreet" value="{{ old('addressNumberStreet') }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="e.g. Block 5 Lot 12, Main Street">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Barangay</label>
                                   <input type="text" name="addressBarangay" value="{{ old('addressBarangay') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="Barangay name">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">District</label>
                                   <input type="text" name="addressDistrict" value="{{ old('addressDistrict') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="District">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">City/Municipality</label>
                                   <input type="text" name="addressCity" value="{{ old('addressCity') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="City/Municipality">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Province</label>
                                   <input type="text" name="addressProvince" value="{{ old('addressProvince') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="Province">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Region</label>
                                   <input type="text" name="addressRegion" value="{{ old('addressRegion') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="Region">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">ZIP Code</label>
                                   <input type="text" name="addressZipCode" value="{{ old('addressZipCode') }}" maxlength="10" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="ZIP Code">
                              </div>
                         </div>
                    </section>

                    {{-- ===== CONTACT INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="contact">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-teal-50 text-sm font-bold text-teal-600 dark:bg-teal-950/40 dark:text-teal-300">
                                   8
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Contact Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Mobile, email, telephone, and other contact details.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Mobile Number <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="tel" name="contactMobile" value="{{ old('contactMobile') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500
                                @error('contactMobile') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 dark:border-slate-700 @enderror"
                                        placeholder="e.g. +639123456789">
                                   @error('contactMobile')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Telephone</label>
                                   <input type="tel" name="contactTel" value="{{ old('contactTel') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="e.g. (02) 1234-5678">
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Email Address</label>
                                   <input type="email" name="contactEmail" value="{{ old('contactEmail') }}" autocomplete="off"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:bg-white dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500
                                @error('contactEmail') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 dark:border-slate-700 @enderror"
                                        placeholder="email@example.com">
                                   @error('contactEmail')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Fax Number</label>
                                   <input type="tel" name="contactFax" value="{{ old('contactFax') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="Fax number">
                              </div>

                              <div class="md:col-span-2">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Other Contact Information</label>
                                   <input type="text" name="contactOthers" value="{{ old('contactOthers') }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500" placeholder="Other contact details">
                              </div>
                         </div>
                    </section>

                    {{-- ===== EDUCATIONAL BACKGROUND ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="education">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sm font-bold text-sky-600 dark:bg-sky-950/40 dark:text-sky-300">
                                   9
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Educational Background
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Highest educational attainment.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Highest Educational Attainment
                                   </label>
                                   <select name="educationalAttainment"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                        <option value="">Select educational attainment</option>
                                        <option value="elementary_graduate" @selected(old('educationalAttainment')==='elementary_graduate' )>Elementary Graduate</option>
                                        <option value="high_school_graduate" @selected(old('educationalAttainment')==='high_school_graduate' )>High School Graduate</option>
                                        <option value="tvet_graduate" @selected(old('educationalAttainment')==='tvet_graduate' )>TVET Graduate</option>
                                        <option value="college_level" @selected(old('educationalAttainment')==='college_level' )>College Level</option>
                                        <option value="college_graduate" @selected(old('educationalAttainment')==='college_graduate' )>College Graduate</option>
                                        <option value="others" @selected(old('educationalAttainment')==='others' )>Others</option>
                                   </select>
                              </div>

                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        If Others, Please Specify
                                   </label>
                                   <input type="text" name="educationalAttainmentOthers" value="{{ old('educationalAttainmentOthers') }}"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                                        placeholder="Specify other educational attainment">
                              </div>
                         </div>
                    </section>

                    {{-- ===== EMPLOYMENT INFORMATION ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="employment">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-lime-50 text-sm font-bold text-lime-600 dark:bg-lime-950/40 dark:text-lime-300">
                                   10
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Employment Information
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Current employment status.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Employment Status
                                   </label>
                                   <select name="employmentStatus"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:border-lime-500 focus:bg-white focus:ring-4 focus:ring-lime-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                        <option value="">Select employment status</option>
                                        <option value="casual" @selected(old('employmentStatus')==='casual' )>Casual</option>
                                        <option value="job_order" @selected(old('employmentStatus')==='job_order' )>Job Order</option>
                                        <option value="probationary" @selected(old('employmentStatus')==='probationary' )>Probationary</option>
                                        <option value="permanent" @selected(old('employmentStatus')==='permanent' )>Permanent</option>
                                        <option value="self_employed" @selected(old('employmentStatus')==='self_employed' )>Self-Employed</option>
                                        <option value="ofw" @selected(old('employmentStatus')==='ofw' )>OFW</option>
                                   </select>
                              </div>
                         </div>
                    </section>

                    {{-- ===== WORK EXPERIENCES ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="work-exp">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-sm font-bold text-amber-600 dark:bg-amber-950/40 dark:text-amber-300">
                                        11
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">Work Experiences</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Add previous work experience records.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addWorkExperience()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add Work Experience
                              </button>
                         </div>

                         <div id="work-experiences-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No work experiences added yet.
                              </p>
                         </div>
                    </section>

                    {{-- ===== TRAININGS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="trainings">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-purple-50 text-sm font-bold text-purple-600 dark:bg-purple-950/40 dark:text-purple-300">
                                        12
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">Training/Seminars Attended</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Add seminars and trainings attended.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addTraining()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add Training
                              </button>
                         </div>

                         <div id="trainings-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No trainings added yet.
                              </p>
                         </div>
                    </section>

                    {{-- ===== LICENSURE EXAMINATIONS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="licensure">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-fuchsia-50 text-sm font-bold text-fuchsia-600 dark:bg-fuchsia-950/40 dark:text-fuchsia-300">
                                        13
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">Licensure Examinations</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Add professional licensure information.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addLicensure()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add Licensure
                              </button>
                         </div>

                         <div id="licensure-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No licensure examinations added yet.
                              </p>
                         </div>
                    </section>

                    {{-- ===== COMPETENCY ASSESSMENTS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="competency">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-pink-50 text-sm font-bold text-pink-600 dark:bg-pink-950/40 dark:text-pink-300">
                                        14
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">Competency Assessments</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Add competency certificates and assessments.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addCompetency()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add Assessment
                              </button>
                         </div>

                         <div id="competency-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No competency assessments added yet.
                              </p>
                         </div>
                    </section>

                    {{-- ===== DOCUMENTS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="documents">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-sm font-bold text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                        15
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">Documents</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Upload supporting documents.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addDocument()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add Document
                              </button>
                         </div>

                         <div id="documents-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No documents added yet.
                              </p>
                         </div>
                    </section>

                    {{-- ===== NTTC ===== --}}
                    <!-- <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="nttc">
                         <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-yellow-50 text-sm font-bold text-yellow-600 dark:bg-yellow-950/40 dark:text-yellow-300">
                                        16
                                   </div>
                                   <div>
                                        <h2 class="text-base font-semibold text-slate-950 dark:text-white">NTTC</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Add National TVET Trainer Certificate details.</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addNTTC()"
                                   class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 dark:bg-emerald-500 dark:hover:bg-emerald-600">
                                   + Add NTTC
                              </button>
                         </div>

                         <div id="nttc-container" data-count="0" class="space-y-3">
                              <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                   No NTTC added yet.
                              </p>
                         </div>
                    </section> -->

                    {{-- ===== TRAINING COURSE AND BATCH ASSIGNMENT ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800" data-section="course-batch">
                         <div class="mb-5 flex items-start gap-3">
                              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                   17
                              </div>
                              <div>
                                   <h2 class="text-base font-semibold text-slate-950 dark:text-white">
                                        Training Course and Batch Assignment
                                   </h2>
                                   <p class="text-sm text-slate-500 dark:text-slate-400">
                                        Select course, training center, and student training batch.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div class="md:col-span-2">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Training Course <span class="text-rose-500">*</span>
                                   </label>
                                   <select name="courseId" id="courseId" onchange="loadCenters(this.value)"
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition focus:bg-white dark:bg-slate-800 dark:text-white
                                @error('courseId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select training course</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" @selected(old('courseId')==$course->id)>
                                             {{ $course->course_name }} - {{ $course->course_code }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('courseId')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Training Center <span class="text-rose-500">*</span>
                                   </label>
                                   <select name="centerId" id="centerId" onchange="loadBatches()" disabled
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition disabled:cursor-not-allowed disabled:opacity-50 dark:bg-slate-800 dark:text-white
                                @error('centerId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select a course first</option>
                                   </select>
                                   @error('centerId')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Student Training Batch <span class="text-rose-500">*</span>
                                   </label>
                                   <select name="batchId" id="batchId" disabled
                                        class="block w-full rounded-xl border bg-slate-50 px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition disabled:cursor-not-allowed disabled:opacity-50 dark:bg-slate-800 dark:text-white
                                @error('batchId') border-rose-300 focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 dark:border-rose-700
                                @else border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 @enderror">
                                        <option value="">Select a center first</option>
                                   </select>
                                   @error('batchId')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </section>

                    {{-- ===== TERMS AND CONDITIONS ===== --}}
                    <section class="border-b border-slate-100 px-5 py-6 dark:border-slate-800">
                         <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                              <div class="flex items-start gap-3">
                                   <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 dark:border-blue-900/50 dark:bg-blue-950/40 dark:text-blue-300">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.955 11.955 0 003 10c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                                        </svg>
                                   </div>

                                   <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-slate-900 dark:text-white">
                                             Certification & Agreement
                                        </h4>
                                        <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                                             I hereby certify that the information provided above is true and correct to the best of my knowledge.
                                             I understand that any false statement or misrepresentation may result in the revocation of my TESDA
                                             accreditation or disqualification from training and assessment activities.
                                        </p>

                                        <label class="mt-4 flex cursor-pointer items-start gap-3">
                                             <input type="checkbox" name="agreedToTerms" value="1" {{ old('agreedToTerms') ? 'checked' : '' }}
                                                  class="mt-0.5 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-900">
                                             <span class="text-xs leading-relaxed text-slate-600 dark:text-slate-300">
                                                  I have read, understood, and agree to the above certification statement and
                                                  <a href="{{ route('data.privacy') }}" class="font-semibold text-blue-600 underline dark:text-blue-400">data privacy</a>
                                                  <span class="text-rose-500">*</span>
                                             </span>
                                        </label>

                                        @error('agreedToTerms')
                                        <p class="mt-2 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                    </section>

                    {{-- ===== FORM ACTIONS ===== --}}
                    <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-5 py-5 dark:border-slate-800 dark:bg-slate-800/40 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-slate-500 dark:text-slate-400">
                              Required fields are marked with <span class="font-semibold text-rose-500">*</span>.
                         </p>

                         <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                              <a href="{{ route('learner-training-applications.index') }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                   <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                   </svg>
                                   Back to List
                              </a>

                              <button type="submit"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 dark:bg-blue-500 dark:hover:bg-blue-600">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                   </svg>
                                   Register New Applicant
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>

     <script>
          const restrictedTypes = ['Cooperative', 'Association'];

          const allSections = {
               uli: document.querySelector('[data-section="uli"]'),
               basic: document.querySelector('[data-section="basic"]'),
               school: document.querySelector('[data-section="school"]'),
               personal: document.querySelector('[data-section="personal"]'),
               address: document.querySelector('[data-section="address"]'),
               contact: document.querySelector('[data-section="contact"]'),
               education: document.querySelector('[data-section="education"]'),
               employment: document.querySelector('[data-section="employment"]'),
               workExp: document.querySelector('[data-section="work-exp"]'),
               trainings: document.querySelector('[data-section="trainings"]'),
               licensure: document.querySelector('[data-section="licensure"]'),
               competency: document.querySelector('[data-section="competency"]'),
               documents: document.querySelector('[data-section="documents"]'),
               nttc: document.querySelector('[data-section="nttc"]'),
               courseBatch: document.querySelector('[data-section="course-batch"]'),
               association: document.querySelector('[data-section="association"]'),
          };

          function applyClientTypeVisibility(clientType) {
               const isRestricted = restrictedTypes.includes(clientType);

               const restrictedHidden = [
                    'uli',
                    'basic',
                    'school',
                    'employment',
                    'workExp',
                    'trainings',
                    'licensure',
                    'competency',
                    'documents',
                    'courseBatch'
               ];

               Object.entries(allSections).forEach(([key, el]) => {
                    if (!el) return;

                    const hide = isRestricted && restrictedHidden.includes(key);
                    const isAssociationSection = key === 'association';
                    const finalHide = isAssociationSection ? !isRestricted : hide;

                    el.classList.toggle('hidden', finalHide);

                    el.querySelectorAll('[required], [data-required]').forEach(field => {
                         if (finalHide) {
                              field.dataset.required = field.required ? '1' : '';
                              field.required = false;
                         } else if (field.dataset.required === '1') {
                              field.required = true;
                         }
                    });
               });
          }

          document.querySelector('[name="clientType"]')?.addEventListener('change', function() {
               applyClientTypeVisibility(this.value);
          });

          applyClientTypeVisibility('{{ old("clientType") }}');

          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);
          // let nttcCount = parseInt(document.getElementById('nttc-container').dataset.count);

          const removeIconSvg = `<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707A1 1 0 014.293 4.293z" clip-rule="evenodd"/>
        </svg>`;

          const dynamicInputClass = 'block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500';
          const dynamicCardClass = 'rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/60';
          const dynamicHeaderClass = 'mb-3 flex items-center justify-between gap-3';
          const dynamicTitleClass = 'text-sm font-semibold text-slate-900 dark:text-white';
          const removeButtonClass = 'inline-flex h-8 w-8 items-center justify-center rounded-xl bg-rose-50 text-rose-600 transition hover:bg-rose-100 dark:bg-rose-950/30 dark:text-rose-300 dark:hover:bg-rose-950/50';

          function removeEmptyNotice(containerId) {
               document.getElementById(containerId).querySelector('.empty-notice')?.remove();
          }

          function addEmptyNoticeIfEmpty(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);

               if (container.querySelectorAll(itemSelector).length === 0) {
                    const p = document.createElement('p');
                    p.className = 'rounded-xl border border-slate-200 bg-slate-50 px-4 py-5 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400';
                    p.textContent = `No ${label.toLowerCase()} added yet.`;
                    container.appendChild(p);
               }
          }

          function reindexInputs(containerId, itemSelector) {
               document.getElementById(containerId).querySelectorAll(itemSelector).forEach((el, i) => {
                    el.querySelectorAll('[name]').forEach(input => {
                         input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
                    });

                    const num = el.querySelector('.item-number');
                    if (num) num.textContent = i + 1;
               });
          }

          function removeItem(btn, containerId, itemSelector, label) {
               if (!confirm(`Remove this ${label}?`)) return;

               btn.closest(itemSelector).remove();
               reindexInputs(containerId, itemSelector);
               addEmptyNoticeIfEmpty(containerId, itemSelector, label);
          }

          function previewPicture(input) {
               if (!input.files || !input.files[0]) return;

               const reader = new FileReader();

               reader.onload = e => {
                    document.getElementById('picture-preview-img').src = e.target.result;
                    document.getElementById('picture-preview').classList.remove('hidden');
               };

               reader.readAsDataURL(input.files[0]);
          }

          function addWorkExperience() {
               removeEmptyNotice('work-experiences-container');

               const i = workExpCount++;

               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', `
                <div class="${dynamicCardClass} work-experience-item">
                    <div class="${dynamicHeaderClass}">
                        <h4 class="${dynamicTitleClass}">Work Experience #<span class="item-number">${document.querySelectorAll('.work-experience-item').length + 1}</span></h4>
                        <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="${removeButtonClass}">${removeIconSvg}</button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <input type="text" name="work_experiences[${i}][company]" placeholder="Company Name" class="${dynamicInputClass}">
                        <input type="text" name="work_experiences[${i}][position]" placeholder="Position" class="${dynamicInputClass}">
                        <input type="text" name="work_experiences[${i}][duration]" placeholder="Duration (e.g., 2020-2023)" class="${dynamicInputClass}">
                        <textarea name="work_experiences[${i}][responsibilities]" placeholder="Responsibilities" rows="2" class="${dynamicInputClass}"></textarea>
                    </div>
                </div>
            `);
          }

          function addTraining() {
               removeEmptyNotice('trainings-container');

               const i = trainingCount++;

               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', `
                <div class="${dynamicCardClass} training-item">
                    <div class="${dynamicHeaderClass}">
                        <h4 class="${dynamicTitleClass}">Training #<span class="item-number">${document.querySelectorAll('.training-item').length + 1}</span></h4>
                        <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="${removeButtonClass}">${removeIconSvg}</button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <input type="text" name="trainings[${i}][title]" placeholder="Training Title" class="${dynamicInputClass}">
                        <input type="text" name="trainings[${i}][provider]" placeholder="Training Provider" class="${dynamicInputClass}">
                        <input type="text" name="trainings[${i}][date]" placeholder="Date (e.g., January 2023)" class="${dynamicInputClass}">
                        <input type="text" name="trainings[${i}][hours]" placeholder="Number of Hours" class="${dynamicInputClass}">
                    </div>
                </div>
            `);
          }

          function addLicensure() {
               removeEmptyNotice('licensure-container');

               const i = licensureCount++;

               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', `
                <div class="${dynamicCardClass} licensure-item">
                    <div class="${dynamicHeaderClass}">
                        <h4 class="${dynamicTitleClass}">Licensure #<span class="item-number">${document.querySelectorAll('.licensure-item').length + 1}</span></h4>
                        <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="${removeButtonClass}">${removeIconSvg}</button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <input type="text" name="licensure_examination[${i}][title]" placeholder="Examination Title" class="${dynamicInputClass}">
                        <input type="text" name="licensure_examination[${i}][license_number]" placeholder="License Number" class="${dynamicInputClass}">
                        <input type="text" name="licensure_examination[${i}][date_taken]" placeholder="Date Taken" class="${dynamicInputClass}">
                        <input type="text" name="licensure_examination[${i}][validity]" placeholder="Validity Period" class="${dynamicInputClass}">
                    </div>
                </div>
            `);
          }

          function addCompetency() {
               removeEmptyNotice('competency-container');

               const i = competencyCount++;

               document.getElementById('competency-container').insertAdjacentHTML('beforeend', `
                <div class="${dynamicCardClass} competency-item">
                    <div class="${dynamicHeaderClass}">
                        <h4 class="${dynamicTitleClass}">Assessment #<span class="item-number">${document.querySelectorAll('.competency-item').length + 1}</span></h4>
                        <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="${removeButtonClass}">${removeIconSvg}</button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <input type="text" name="competency_assessment[${i}][qualification]" placeholder="Qualification Title" class="${dynamicInputClass}">
                        <input type="text" name="competency_assessment[${i}][certificate_number]" placeholder="Certificate Number" class="${dynamicInputClass}">
                        <input type="text" name="competency_assessment[${i}][date_issued]" placeholder="Date Issued" class="${dynamicInputClass}">
                        <input type="text" name="competency_assessment[${i}][expiry_date]" placeholder="Expiry Date" class="${dynamicInputClass}">
                    </div>
                </div>
            `);
          }

          // function addNTTC() {
          //      removeEmptyNotice('nttc-container');

          //      const i = nttcCount++;

          //      document.getElementById('nttc-container').insertAdjacentHTML('beforeend', `
          //       <div class="${dynamicCardClass} nttc-item">
          //           <div class="${dynamicHeaderClass}">
          //               <h4 class="${dynamicTitleClass}">NTTC #<span class="item-number">${document.querySelectorAll('.nttc-item').length + 1}</span></h4>
          //               <button type="button" onclick="removeItem(this,'nttc-container','.nttc-item','NTTC')" class="${removeButtonClass}">${removeIconSvg}</button>
          //           </div>

          //           <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
          //               <select name="nttc[${i}][level]" class="${dynamicInputClass}">
          //                   <option value="">Select Level</option>
          //                   <option value="Level I">Level I</option>
          //                   <option value="Level II">Level II</option>
          //                   <option value="Level III">Level III</option>
          //                   <option value="Level IV">Level IV</option>
          //               </select>
          //               <input type="text" name="nttc[${i}][competency]" placeholder="Competency (e.g. Cookery NC II)" class="${dynamicInputClass}">
          //               <input type="text" name="nttc[${i}][certificate_number]" placeholder="Certificate Number" class="${dynamicInputClass}">
          //               <input type="date" name="nttc[${i}][issued_on]" class="${dynamicInputClass}">
          //               <input type="date" name="nttc[${i}][valid_until]" class="${dynamicInputClass}">
          //               <input type="file" name="nttc[${i}][file]" class="${dynamicInputClass}">
          //           </div>
          //       </div>
          //   `);
          // }

          const documentTypeOptions = `
            <option value="">Select document type</option>
            @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
            <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
            @endforeach
        `;

          function addDocument() {
               removeEmptyNotice('documents-container');

               const i = documentCount++;

               document.getElementById('documents-container').insertAdjacentHTML('beforeend', `
                <div class="${dynamicCardClass} document-item">
                    <div class="${dynamicHeaderClass}">
                        <h4 class="${dynamicTitleClass}">Document #<span class="item-number">${document.querySelectorAll('.document-item').length + 1}</span></h4>
                        <button type="button" onclick="removeItem(this,'documents-container','.document-item','Document')" class="${removeButtonClass}">${removeIconSvg}</button>
                    </div>

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <select name="documents[${i}][type]" class="${dynamicInputClass}">
                            ${documentTypeOptions}
                        </select>
                        <input type="file" name="documents[${i}][file]" class="${dynamicInputClass}">
                    </div>
                </div>
            `);
          }

          function loadCenters(courseId) {
               const centerSelect = document.getElementById('centerId');
               const batchSelect = document.getElementById('batchId');

               centerSelect.innerHTML = '<option value="">Loading...</option>';
               centerSelect.disabled = true;

               batchSelect.innerHTML = '<option value="">Select a center first</option>';
               batchSelect.disabled = true;

               if (!courseId) {
                    centerSelect.innerHTML = '<option value="">Select a course first</option>';
                    return;
               }

               fetch(`{{ route('learner-applications.getCenters') }}?course_id=${courseId}`, {
                         headers: {
                              'X-Requested-With': 'XMLHttpRequest'
                         }
                    })
                    .then(r => r.json())
                    .then(centers => {
                         centerSelect.innerHTML = '<option value="">Select training center</option>';

                         centers.forEach(c => {
                              centerSelect.insertAdjacentHTML('beforeend', `<option value="${c.id}">${c.name}</option>`);
                         });

                         centerSelect.disabled = false;
                    });
          }

          function loadBatches() {
               const courseId = document.getElementById('courseId').value;
               const centerId = document.getElementById('centerId').value;
               const batchSelect = document.getElementById('batchId');

               batchSelect.innerHTML = '<option value="">Loading...</option>';
               batchSelect.disabled = true;

               if (!courseId || !centerId) return;

               fetch(`{{ route('learner-applications.getBatches') }}?course_id=${courseId}&center_id=${centerId}`, {
                         headers: {
                              'X-Requested-With': 'XMLHttpRequest'
                         }
                    })
                    .then(r => r.json())
                    .then(batches => {
                         batchSelect.innerHTML = '<option value="">— Select a training batch —</option>';

                         batches.forEach(b => {
                              const start = new Date(b.start_date).toLocaleDateString('en-US', {
                                   month: 'short',
                                   day: 'numeric',
                                   year: 'numeric'
                              });

                              const end = new Date(b.end_date).toLocaleDateString('en-US', {
                                   month: 'short',
                                   day: 'numeric',
                                   year: 'numeric'
                              });

                              batchSelect.insertAdjacentHTML(
                                   'beforeend',
                                   `<option value="${b.id}">${b.batch_name} • ${b.batch_code} • (${start} – ${end})</option>`
                              );
                         });

                         batchSelect.disabled = false;
                    });
          }
     </script>
</x-layouts.app.flowbite>