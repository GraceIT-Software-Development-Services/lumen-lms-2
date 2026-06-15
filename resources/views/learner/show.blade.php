<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto space-y-5">
          <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800">

               {{-- Header --}}
               <div class="flex flex-col gap-4 border-b border-slate-200 bg-gradient-to-br from-white via-slate-50 to-indigo-50/80 p-5 dark:border-slate-800 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 sm:flex-row sm:items-center sm:justify-between md:p-6">
                    <div class="flex items-center gap-3">
                         <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl border border-indigo-100 bg-indigo-50 text-indigo-600 shadow-sm dark:border-indigo-900/60 dark:bg-indigo-950/40 dark:text-indigo-300">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                         </div>
                         <div>
                              <h3 class="text-xl font-semibold tracking-tight text-slate-900 dark:text-white">Update {{ auth()->user()->hasRole('Trainer') ? 'Trainer' : 'Learner' }} Information</h3>
                              <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                   Update the details of
                                   <span class="font-semibold text-slate-700 dark:text-slate-200">
                                        {{ $learner->name }} {{ $learner->last_name }}
                                   </span>
                              </p>
                         </div>
                    </div>

                    @if (auth()->user()->hasRole('Student'))
                    <div class="inline-flex self-start items-center gap-1.5 rounded-full border border-indigo-100 bg-white dark:bg-slate-900 px-3 py-1.5 shadow-sm dark:border-indigo-900/60 dark:bg-slate-950 sm:self-center">
                         <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                         </svg>
                         <span class="text-xs font-medium text-slate-500 dark:text-slate-400">ULI:</span>
                         <span class="font-mono text-xs font-semibold text-indigo-600 dark:text-indigo-300">{{ $learner->uli ?: '—' }}</span>
                    </div>
                    @endif
               </div>

               {{-- Flash Messages --}}
               @if(session('success'))
               <div class="m-4 rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-sm font-medium text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-300 md:m-5" role="alert">{{ session('success') }}</div>
               @endif
               @if(session('error'))
               <div class="m-4 rounded-2xl border border-rose-100 bg-rose-50 p-4 text-sm font-medium text-rose-700 dark:border-rose-900/50 dark:bg-rose-950/40 dark:text-rose-300 md:m-5" role="alert">{{ session('error') }}</div>
               @endif

               <form action="{{ route('learners.update', $learner->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-slate-50/70 p-4 dark:bg-slate-950/60 md:p-6">

                    @csrf
                    @method('PUT')

                    {{-- Hidden container: collects IDs of documents removed from DOM --}}
                    <div id="deleted-document-ids-container"></div>

                    {{-- ULI --}}
                    @if (auth()->user()->hasRole('Student'))
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="uli">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Unique Learner Identifier</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Unique Learner Identifier <span class="text-rose-500">*</span>
                                   </label>
                                   <input type="text" name="uli" value="{{ old('uli', $learner->uli) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('uli') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Enter unique learner identifier">
                                   @error('uli')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>
                    @endif

                    {{-- Other Information --}}
                    @if (auth()->user()->hasRole('Trainer') || auth()->user()->hasRole('Student'))
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Other Information</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Client Type</label>
                                   <select name="clientType" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <option value="">Select client type</option>
                                        <option value="Industry Worker" @selected(old('clientType', $learner->client_type) === 'Industry Worker')>Industry Worker</option>
                                        <option value="Student" @selected(old('clientType', $learner->client_type) === 'Student')>Student</option>
                                        <option value="Cooperative" @selected(old('clientType', $learner->client_type) === 'Cooperative')>Cooperative</option>
                                        <option value="Association" @selected(old('clientType', $learner->client_type) === 'Association')>Association</option>
                                        <option value="Graduate" @selected(old('clientType', $learner->client_type) === 'Graduate')>Graduate</option>
                                   </select>
                                   @error('clientType')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>

                              @if (auth()->user()->hasRole('Trainer'))
                              <div data-section="association">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Association / Cooperative</label>
                                   <select name="association_ids[]" multiple class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <option value="">Select association / cooperative</option>
                                        @foreach ($associations as $association)
                                        <option value="{{ $association->id }}" {{ $user_associations->contains('association_id', $association->id) ? 'selected' : '' }}>
                                             {{ $association->name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('association_ids')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              @endif

                              <div class="md:col-span-3">
                                   <label for="picture" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Profile Picture</label>
                                   <input type="file" id="picture" name="picture" accept="image/*"
                                        class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white dark:bg-slate-900 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        onchange="previewPicture(this)">

                                   {{-- Current picture from S3 --}}
                                   @if($learner->picture_path)
                                   <div id="current-picture" class="mt-3 flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-800/50">
                                        <img src="{{ Storage::disk('s3')->temporaryUrl($learner->picture_path, now()->addMinutes(5)) }}"
                                             class="h-20 w-20 rounded-2xl border border-slate-200 object-cover shadow-sm dark:border-slate-700">
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Current picture — upload a new one to replace</p>
                                   </div>
                                   @endif

                                   {{-- Preview of newly selected picture --}}
                                   <div id="picture-preview" class="mt-2 hidden">
                                        <img id="picture-preview-img" src="" class="h-20 w-20 rounded-2xl border border-slate-200 object-cover shadow-sm dark:border-slate-700">
                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">New photo selected (not yet saved)</p>
                                   </div>

                                   @error('picture')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>
                    @endif

                    {{-- Basic Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="basic">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Basic Information</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">First Name <span class="text-rose-500">*</span></label>
                                   <input type="text" name="firstName" value="{{ old('firstName', $learner->name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('firstName') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Enter first name">
                                   @error('firstName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Middle Name</label>
                                   <input type="text" name="middleName" value="{{ old('middleName', $learner->middle_name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Enter middle name">
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Last Name <span class="text-rose-500">*</span></label>
                                   <input type="text" name="lastName" value="{{ old('lastName', $learner->last_name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('lastName') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Enter last name">
                                   @error('lastName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Suffix</label>
                                   <input type="text" name="suffix" value="{{ old('suffix', $learner->extension) }}" maxlength="10" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Jr., Sr., III, etc.">
                              </div>
                         </div>
                    </div>

                    {{-- School Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="school">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">School Information</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">School Name</label>
                                   <input type="text" name="schoolName" value="{{ old('schoolName', $learner->school_name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('schoolName') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="e.g. XYZ Technical School">
                                   @error('schoolName')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">School Address</label>
                                   <textarea name="schoolAddress" rows="1" autocomplete="off"
                                        class="block w-full rounded-xl border @error('schoolAddress') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Complete school address">{{ old('schoolAddress', $learner->school_address) }}</textarea>
                                   @error('schoolAddress')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="personal">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Personal Information</h2>
                         <p class="mb-4 inline-flex items-center gap-1.5 rounded-full bg-slate-50 px-3 py-1 text-xs font-medium text-slate-500 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:ring-slate-700">
                              <svg class="h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                   <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                              </svg>
                              Personal information is encrypted and stored securely
                         </p>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Sex <span class="text-rose-500">*</span></label>
                                   <select name="sex" class="block w-full rounded-xl border @error('sex') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <option value="">Select sex</option>
                                        <option value="male" @selected(old('sex', $learner->sex) === 'male')>Male</option>
                                        <option value="female" @selected(old('sex', $learner->sex) === 'female')>Female</option>
                                   </select>
                                   @error('sex')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Civil Status <span class="text-rose-500">*</span></label>
                                   <select name="civilStatus" class="block w-full rounded-xl border @error('civilStatus') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <option value="">Select civil status</option>
                                        <option value="single" @selected(old('civilStatus', $learner->civil_status) === 'single')>Single</option>
                                        <option value="married" @selected(old('civilStatus', $learner->civil_status) === 'married')>Married</option>
                                        <option value="widow" @selected(old('civilStatus', $learner->civil_status) === 'widow')>Widow</option>
                                        <option value="separated" @selected(old('civilStatus', $learner->civil_status) === 'separated')>Separated</option>
                                   </select>
                                   @error('civilStatus')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Date of Birth <span class="text-rose-500">*</span></label>
                                   <input type="date" name="birthDate" value="{{ old('birthDate', $learner->birth_date) }}"
                                        class="block w-full rounded-xl border @error('birthDate') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                   @error('birthDate')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Place of Birth</label>
                                   <input type="text" name="birthPlace" value="{{ old('birthPlace', $learner->birth_place) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="City/Municipality, Province">
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Mother's Name</label>
                                   <input type="text" name="motherName" value="{{ old('motherName', $learner->mother_name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Full name">
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Father's Name</label>
                                   <input type="text" name="fatherName" value="{{ old('fatherName', $learner->father_name) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Full name">
                              </div>
                         </div>
                    </div>

                    {{-- Address Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="address">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Address Information</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                              <div class="md:col-span-3">
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">House/Block/Lot No., Street</label>
                                   <input type="text" name="addressNumberStreet" value="{{ old('addressNumberStreet', $learner->address_number_street) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="e.g. Block 5 Lot 12, Main Street">
                              </div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Barangay</label><input type="text" name="addressBarangay" value="{{ old('addressBarangay', $learner->address_barangay) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="Barangay name"></div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">District</label><input type="text" name="addressDistrict" value="{{ old('addressDistrict', $learner->address_district) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="District"></div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">City/Municipality</label><input type="text" name="addressCity" value="{{ old('addressCity', $learner->address_city) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="City"></div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Province</label><input type="text" name="addressProvince" value="{{ old('addressProvince', $learner->address_province) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="Province"></div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Region</label><input type="text" name="addressRegion" value="{{ old('addressRegion', $learner->address_region) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="Region"></div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">ZIP Code</label><input type="text" name="addressZipCode" value="{{ old('addressZipCode', $learner->address_zip_code) }}" maxlength="10" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="ZIP Code"></div>
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="contact">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Contact Information</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Mobile Number <span class="text-rose-500">*</span></label>
                                   <input type="tel" name="contactMobile" value="{{ old('contactMobile', $learner->contact_mobile) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('contactMobile') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="e.g. +639123456789">
                                   @error('contactMobile')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Telephone</label><input type="tel" name="contactTel" value="{{ old('contactTel', $learner->contact_tel) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="e.g. (02) 1234-5678"></div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Email Address</label>
                                   <input type="email" name="contactEmail" value="{{ old('contactEmail', $learner->contact_email) }}" autocomplete="off"
                                        class="block w-full rounded-xl border @error('contactEmail') border-rose-400 ring-4 ring-rose-50 dark:ring-rose-950/40 @else border-slate-200 dark:border-slate-700 @enderror bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="email@example.com">
                                   @error('contactEmail')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Fax Number</label>
                                   <input type="tel" name="contactFax" value="{{ old('contactFax', $learner->contact_fax) }}" autocomplete="off"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Fax number">
                              </div>
                              <div class="md:col-span-2"><label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Other Contact Information</label><input type="text" name="contactOthers" value="{{ old('contactOthers', $learner->contact_others) }}" autocomplete="off" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40" placeholder="Other contact details"></div>
                         </div>
                    </div>

                    {{-- Educational Background --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="education">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Educational Background</h2>
                         <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Highest Educational Attainment</label>
                                   <select name="educationalAttainment" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <option value="">Select educational attainment</option>
                                        <option value="elementary_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'elementary_graduate')>Elementary Graduate</option>
                                        <option value="high_school_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'high_school_graduate')>High School Graduate</option>
                                        <option value="tvet_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'tvet_graduate')>TVET Graduate</option>
                                        <option value="college_level" @selected(old('educationalAttainment', $learner->educational_attainment) === 'college_level')>College Level</option>
                                        <option value="college_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'college_graduate')>College Graduate</option>
                                        <option value="others" @selected(old('educationalAttainment', $learner->educational_attainment) === 'others')>Others</option>
                                   </select>
                                   @error('educationalAttainment')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">If Others, Please Specify</label>
                                   <input type="text" name="educationalAttainmentOthers" value="{{ old('educationalAttainmentOthers', $learner->educational_attainment_others) }}"
                                        class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"
                                        placeholder="Specify other educational attainment">
                              </div>
                         </div>
                    </div>

                    {{-- Employment Information --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="employment">
                         <h2 class="mb-4 text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Employment Information</h2>
                         <div>
                              <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Employment Status</label>
                              <select name="employmentStatus" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                   <option value="">Select employment status</option>
                                   <option value="casual" @selected(old('employmentStatus', $learner->employment_status) === 'casual')>Casual</option>
                                   <option value="job_order" @selected(old('employmentStatus', $learner->employment_status) === 'job_order')>Job Order</option>
                                   <option value="probationary" @selected(old('employmentStatus', $learner->employment_status) === 'probationary')>Probationary</option>
                                   <option value="permanent" @selected(old('employmentStatus', $learner->employment_status) === 'permanent')>Permanent</option>
                                   <option value="self_employed" @selected(old('employmentStatus', $learner->employment_status) === 'self_employed')>Self-Employed</option>
                                   <option value="ofw" @selected(old('employmentStatus', $learner->employment_status) === 'ofw')>OFW</option>
                              </select>
                              @error('employmentStatus')<p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>@enderror
                         </div>
                    </div>

                    {{-- Work Experiences --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="work-exp">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Work Experiences</h2>
                              <button type="button" onclick="addWorkExperience()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Work Experience</button>
                         </div>
                         <div id="work-experiences-container" data-count="{{ count($workExperiences) }}" class="space-y-3">
                              @forelse($workExperiences as $index => $experience)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 work-experience-item">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Work Experience #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <input type="text" name="work_experiences[{{ $index }}][company]" value="{{ $experience['company'] ?? '' }}" placeholder="Company Name" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="work_experiences[{{ $index }}][position]" value="{{ $experience['position'] ?? '' }}" placeholder="Position" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="work_experiences[{{ $index }}][duration]" value="{{ $experience['duration'] ?? '' }}" placeholder="Duration (e.g., 2020-2023)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <textarea name="work_experiences[{{ $index }}][responsibilities]" placeholder="Responsibilities" rows="2" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">{{ $experience['responsibilities'] ?? '' }}</textarea>
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No work experiences added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Trainings --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="trainings">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Training/Seminars Attended</h2>
                              <button type="button" onclick="addTraining()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Training</button>
                         </div>
                         <div id="trainings-container" data-count="{{ count($trainings) }}" class="space-y-3">
                              @forelse($trainings as $index => $training)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 training-item">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Training #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <input type="text" name="trainings[{{ $index }}][title]" value="{{ $training['title'] ?? '' }}" placeholder="Training Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="trainings[{{ $index }}][provider]" value="{{ $training['provider'] ?? '' }}" placeholder="Training Provider" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="trainings[{{ $index }}][date]" value="{{ $training['date'] ?? '' }}" placeholder="Date (e.g., January 2023)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="trainings[{{ $index }}][hours]" value="{{ $training['hours'] ?? '' }}" placeholder="Number of Hours" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No trainings added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Licensure Examinations --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="licensure">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Licensure Examinations</h2>
                              <button type="button" onclick="addLicensure()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Licensure</button>
                         </div>
                         <div id="licensure-container" data-count="{{ count($licensureExamination) }}" class="space-y-3">
                              @forelse($licensureExamination as $index => $licensure)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 licensure-item">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Licensure #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <input type="text" name="licensure_examination[{{ $index }}][title]" value="{{ $licensure['title'] ?? '' }}" placeholder="Examination Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="licensure_examination[{{ $index }}][license_number]" value="{{ $licensure['license_number'] ?? '' }}" placeholder="License Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="licensure_examination[{{ $index }}][date_taken]" value="{{ $licensure['date_taken'] ?? '' }}" placeholder="Date Taken" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="licensure_examination[{{ $index }}][validity]" value="{{ $licensure['validity'] ?? '' }}" placeholder="Validity Period" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No licensure examinations added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Competency Assessments --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="competency">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Competency Assessments</h2>
                              <button type="button" onclick="addCompetency()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Assessment</button>
                         </div>
                         <div id="competency-container" data-count="{{ count($competencyAssessment) }}" class="space-y-3">
                              @forelse($competencyAssessment as $index => $competency)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 competency-item">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Assessment #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <input type="text" name="competency_assessment[{{ $index }}][qualification]" value="{{ $competency['qualification'] ?? '' }}" placeholder="Qualification Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="competency_assessment[{{ $index }}][certificate_number]" value="{{ $competency['certificate_number'] ?? '' }}" placeholder="Certificate Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="competency_assessment[{{ $index }}][date_issued]" value="{{ $competency['date_issued'] ?? '' }}" placeholder="Date Issued" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="competency_assessment[{{ $index }}][expiry_date]" value="{{ $competency['expiry_date'] ?? '' }}" placeholder="Expiry Date" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No competency assessments added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Nttc --}}
                    @if (auth()->user()->hasRole('Trainer'))
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="nttc">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Nttc</h2>
                              <button type="button" onclick="addNttc()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Nttc</button>
                         </div>
                         <div id="nttc-container" data-count="{{ count($nttc) }}" class="space-y-3">
                              @forelse($nttc as $index => $nttcItem)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 nttc-item">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nttc #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'nttc-container','.nttc-item','Nttc')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <select name="nttc[{{ $index }}][level]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                             <option value="">Select Level</option>
                                             <option value="Level I" {{ ($nttcItem['level'] ?? '') === 'Level I' ? 'selected' : '' }}>Level I</option>
                                             <option value="Level II" {{ ($nttcItem['level'] ?? '') === 'Level II' ? 'selected' : '' }}>Level II</option>
                                             <option value="Level III" {{ ($nttcItem['level'] ?? '') === 'Level III' ? 'selected' : '' }}>Level III</option>
                                             <option value="Level IV" {{ ($nttcItem['level'] ?? '') === 'Level IV' ? 'selected' : '' }}>Level IV</option>
                                        </select>
                                        <input type="text" name="nttc[{{ $index }}][competency]" value="{{ $nttcItem['competency'] ?? '' }}" placeholder="Competency (e.g. Cookery NC II)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="text" name="nttc[{{ $index }}][certificate_number]" value="{{ $nttcItem['certificate_number'] ?? '' }}" placeholder="Certificate Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="date" name="nttc[{{ $index }}][issued_on]" value="{{ $nttcItem['issued_on'] ?? '' }}" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="date" name="nttc[{{ $index }}][valid_until]" value="{{ $nttcItem['valid_until'] ?? '' }}" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        <input type="file" name="nttc[{{ $index }}][file]" class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white dark:bg-slate-900 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:file:bg-indigo-950/50 dark:file:text-indigo-300 dark:hover:file:bg-indigo-900/60 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">

                                        @if(!empty($nttcItem['file_path']))
                                        <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white dark:bg-slate-900 p-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 md:col-span-2">
                                             <svg class="h-4 w-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                             </svg>
                                             <a href="{{ Storage::disk('s3')->temporaryUrl($nttcItem['file_path'], now()->addMinutes(10)) }}" target="_blank" class="flex-1 truncate text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-300">
                                                  {{ basename($nttcItem['file_path']) }}
                                             </a>
                                        </div>
                                        @endif
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No competency assessments added yet.</p>
                              @endforelse
                         </div>
                    </div>
                    @endif

                    {{-- Documents --}}
                    <div class="rounded-2xl border border-slate-200 bg-white dark:bg-slate-900 p-5 shadow-sm ring-1 ring-slate-100/70 dark:border-slate-800 dark:bg-slate-900 dark:ring-slate-800/70" data-section="documents">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">Documents</h2>
                              <button type="button" onclick="addDocument()" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/40">+ Add Document</button>
                         </div>
                         <div id="documents-container" data-count="{{ count($documents) }}" class="space-y-3">
                              @forelse($documents as $index => $document)
                              <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 document-item" data-doc-id="{{ $document->id }}">
                                   <div class="mb-3 flex items-center justify-between gap-3">
                                        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Document #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeDocument(this)" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        <input type="hidden" name="documents[{{ $index }}][id]" value="{{ $document->id }}">
                                        <select name="documents[{{ $index }}][type]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                             <option value="">Select document type</option>
                                             @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                                             <option value="{{ $type->value }}" @selected($document->type === $type->value)>
                                                  {{ str_replace('_', ' ', $type->name) }}
                                             </option>
                                             @endforeach
                                        </select>
                                        <input type="file" name="documents[{{ $index }}][file]"
                                             class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white dark:bg-slate-900 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                                        @if($document->file)
                                        <div class="flex items-center gap-2 rounded-xl bg-slate-50 p-3 dark:bg-slate-800/50 md:col-span-2">
                                             <svg class="h-4 w-4 flex-shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                             </svg>
                                             <a href="{{ Storage::disk('s3')->temporaryUrl($document->file, now()->addMinute(1)) }}"
                                                  target="_blank" class="truncate text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-300">
                                                  {{ basename($document->file) }}
                                             </a>
                                             <span class="text-xs text-slate-400 dark:text-slate-500">(upload new file to replace)</span>
                                        </div>
                                        @endif
                                   </div>
                              </div>
                              @empty
                              <p class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400">No documents added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="sticky bottom-0 z-20 -mx-4 -mb-4 flex flex-wrap items-center gap-3 border-t border-slate-200 bg-white dark:bg-slate-900/90 p-4 backdrop-blur dark:border-slate-800 dark:bg-slate-900/90 md:-mx-6 md:-mb-6 md:p-5">
                         <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:focus:ring-indigo-900/40">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                              </svg>
                              Update {{ auth()->user()->hasRole('Trainer') ? 'trainer' : 'learner' }} information
                         </button>
                    </div>
               </form>
          </div>
     </div>

     <script>
          // ─── Client Type conditional sections ────────────────────────────────────────
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
               user_association: document.querySelector('[data-section="user_association"]'),
          };

          function applyClientTypeVisibility(clientType) {
               const isRestricted = restrictedTypes.includes(clientType);

               // Sections hidden for Cooperative / Association
               const restrictedHidden = ['uli', 'basic', 'school', 'employment', 'workExp', 'trainings', 'licensure', 'competency', 'courseBatch'];

               Object.entries(allSections).forEach(([key, el]) => {
                    if (!el) return;
                    const hide = isRestricted && restrictedHidden.includes(key);

                    // Association section: show ONLY for Cooperative/Association, hide for others
                    const isAssociationSection = key === 'association';
                    const finalHide = isAssociationSection ? !isRestricted : hide;

                    el.classList.toggle('hidden', finalHide);

                    // Disable required fields inside hidden sections so they don't block submit
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

          const clientTypeSelect = document.querySelector('[name="clientType"]');
          if (clientTypeSelect) {
               clientTypeSelect.addEventListener('change', function() {
                    applyClientTypeVisibility(this.value);
               });
               // Run on page load to handle old() repopulation
               applyClientTypeVisibility(clientTypeSelect.value);
          }

          // ─── Counters from server-rendered items ──────────────────────────────────
          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);
          let nttcCount = parseInt(document.getElementById('nttc-container')?.dataset.count ?? '0');

          const removeIconSvg = `<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
     <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
</svg>`;

          // ─── Shared helpers ───────────────────────────────────────────────────────
          function removeEmptyNotice(containerId) {
               document.getElementById(containerId).querySelector('.empty-notice')?.remove();
          }

          function addEmptyNoticeIfEmpty(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);
               if (container.querySelectorAll(itemSelector).length === 0) {
                    const p = document.createElement('p');
                    p.className = 'rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-6 text-center text-sm text-slate-500 empty-notice dark:border-slate-700 dark:bg-slate-800/40 dark:text-slate-400';
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

          // ─── Picture preview ──────────────────────────────────────────────────────
          function previewPicture(input) {
               if (!input.files || !input.files[0]) return;
               const reader = new FileReader();
               reader.onload = e => {
                    document.getElementById('picture-preview-img').src = e.target.result;
                    document.getElementById('picture-preview').classList.remove('hidden');
               };
               reader.readAsDataURL(input.files[0]);
          }

          // ─── Work Experiences ─────────────────────────────────────────────────────
          function addWorkExperience() {
               removeEmptyNotice('work-experiences-container');
               const i = workExpCount++;
               const total = document.querySelectorAll('.work-experience-item').length + 1;
               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 work-experience-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Work Experience #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <input type="text" name="work_experiences[${i}][company]" placeholder="Company Name" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="work_experiences[${i}][position]" placeholder="Position" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="work_experiences[${i}][duration]" placeholder="Duration (e.g., 2020-2023)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <textarea name="work_experiences[${i}][responsibilities]" placeholder="Responsibilities" rows="2" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40"></textarea>
          </div>
     </div>`);
          }

          // ─── Trainings ────────────────────────────────────────────────────────────
          function addTraining() {
               removeEmptyNotice('trainings-container');
               const i = trainingCount++;
               const total = document.querySelectorAll('.training-item').length + 1;
               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 training-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Training #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <input type="text" name="trainings[${i}][title]" placeholder="Training Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="trainings[${i}][provider]" placeholder="Training Provider" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="trainings[${i}][date]" placeholder="Date (e.g., January 2023)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="trainings[${i}][hours]" placeholder="Number of Hours" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
          </div>
     </div>`);
          }

          // ─── Licensure ────────────────────────────────────────────────────────────
          function addLicensure() {
               removeEmptyNotice('licensure-container');
               const i = licensureCount++;
               const total = document.querySelectorAll('.licensure-item').length + 1;
               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 licensure-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Licensure #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <input type="text" name="licensure_examination[${i}][title]" placeholder="Examination Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="licensure_examination[${i}][license_number]" placeholder="License Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="licensure_examination[${i}][date_taken]" placeholder="Date Taken" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="licensure_examination[${i}][validity]" placeholder="Validity Period" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
          </div>
     </div>`);
          }

          // ─── Competency ───────────────────────────────────────────────────────────
          function addCompetency() {
               removeEmptyNotice('competency-container');
               const i = competencyCount++;
               const total = document.querySelectorAll('.competency-item').length + 1;
               document.getElementById('competency-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 competency-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Assessment #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <input type="text" name="competency_assessment[${i}][qualification]" placeholder="Qualification Title" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="competency_assessment[${i}][certificate_number]" placeholder="Certificate Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="competency_assessment[${i}][date_issued]" placeholder="Date Issued" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="competency_assessment[${i}][expiry_date]" placeholder="Expiry Date" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
          </div>
     </div>`);
          }

          // ─── Nttc ───────────────────────────────────────────────────────────
          function addNttc() {
               removeEmptyNotice('nttc-container');
               const i = nttcCount++;
               const total = document.querySelectorAll('.nttc-item').length + 1;
               document.getElementById('nttc-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 nttc-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nttc #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeItem(this,'nttc-container','.nttc-item','Nttc')" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <select name="nttc[${i}][level]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                    <option value="">Select Level</option>
                    <option value="Level I">Level I</option>
                    <option value="Level II">Level II</option>
                    <option value="Level III">Level III</option>
                    <option value="Level IV">Level IV</option>
               </select>
               <input type="text" name="nttc[${i}][competency]" placeholder="Competency (e.g. Cookery NC II)" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="text" name="nttc[${i}][certificate_number]" placeholder="Certificate Number" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="date" name="nttc[${i}][issued_on]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="date" name="nttc[${i}][valid_until]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
               <input type="file" name="nttc[${i}][file]" class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white dark:bg-slate-900 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:file:bg-indigo-950/50 dark:file:text-indigo-300 dark:hover:file:bg-indigo-900/60 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
          </div>
     </div>`);
          }

          // ─── Documents ────────────────────────────────────────────────────────────
          const documentTypeOptions = `
     <option value="">Select document type</option>
     @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
     <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
     @endforeach
`;

          function addDocument() {
               removeEmptyNotice('documents-container');
               const i = documentCount++;
               const total = document.querySelectorAll('.document-item').length + 1;
               document.getElementById('documents-container').insertAdjacentHTML('beforeend', `
     <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 shadow-sm transition hover:border-slate-300 hover:bg-white dark:bg-slate-900 dark:border-slate-700 dark:bg-slate-800/50 dark:hover:border-slate-600 dark:hover:bg-slate-800 document-item">
          <div class="mb-3 flex items-center justify-between gap-3">
               <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Document #<span class="item-number">${total}</span></h4>
               <button type="button" onclick="removeDocument(this)" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-rose-500 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-950/40">${removeIconSvg}</button>
          </div>
          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
               <select name="documents[${i}][type]" class="block w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-700 shadow-sm outline-none placeholder:text-slate-400 transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
                    ${documentTypeOptions}
               </select>
               <input type="file" name="documents[${i}][file]"
                    class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white dark:bg-slate-900 text-sm text-slate-600 shadow-sm outline-none transition file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:file:bg-slate-800 dark:file:text-slate-200 dark:hover:file:bg-slate-700 dark:focus:border-indigo-400 dark:focus:ring-indigo-900/40">
          </div>
     </div>`);
          }

          // ─── Remove document: track DB records for S3 deletion on submit ──────────
          function removeDocument(btn) {
               if (!confirm('Are you sure you want to remove this document? This will permanently delete the file and cannot be undone.')) return;

               const item = btn.closest('.document-item');
               const docId = item.dataset.docId; // only present for existing DB records

               if (docId) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_document_ids[]';
                    input.value = docId;
                    document.getElementById('deleted-document-ids-container').appendChild(input);
               }

               item.remove();
               reindexInputs('documents-container', '.document-item');
               addEmptyNoticeIfEmpty('documents-container', '.document-item', 'Documents');
          }
     </script>
</x-layouts.app.flowbite>