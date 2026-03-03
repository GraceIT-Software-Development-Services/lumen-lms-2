<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Update the learner details and personal information
                         </p>
                    </div>
                    <div class="flex flex-col items-end">
                         <div class="flex items-center gap-2 bg-red-50 border border-red-100 rounded-xl px-4 py-2.5">
                              <svg class="w-3.5 h-3.5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                              </svg>
                              <div>
                                   <p class="text-[10px] font-semibold text-red-400 uppercase tracking-wider leading-none mb-0.5">Unique Learner Identifier</p>
                                   <p class="text-sm font-bold text-red-700 font-mono tracking-widest">{{ strtoupper($learner->uli) }}</p>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Flash Messages --}}
               @if(session('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif
               @if(session('error'))
               <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg" role="alert">
                    {{ session('error') }}
               </div>
               @endif

               <form action="{{ route('learners.update', $learner->uuid) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Hidden input to collect deleted document IDs --}}
                    <div id="deleted-document-ids-container"></div>

                    {{-- Basic Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Client Type</label>
                                   <select name="client_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select client type</option>
                                        <option value="tvet_graduating_student" @selected(old('client_type', $learner->client_type) === 'tvet_graduating_student')>TVET Graduating Student</option>
                                        <option value="tvet_graduate" @selected(old('client_type', $learner->client_type) === 'tvet_graduate')>TVET Graduate</option>
                                        <option value="industry_worker" @selected(old('client_type', $learner->client_type) === 'industry_worker')>Industry Worker</option>
                                        <option value="k12" @selected(old('client_type', $learner->client_type) === 'k12')>K12</option>
                                        <option value="owf" @selected(old('client_type', $learner->client_type) === 'owf')>OWF</option>
                                   </select>
                                   @error('client_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>

                              <div class="md:col-span-3">
                                   <label for="picture" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>
                                   <input type="file" id="picture" name="picture" accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                        onchange="previewPicture(this)">

                                   <div id="picture-preview" class="mt-2 {{ $learner->picture_path ? '' : 'hidden' }}">
                                        @if($learner->picture_path)
                                        <img id="picture-preview-img"
                                             src="{{ Storage::disk('s3')->temporaryUrl($learner->picture_path, now()->addMinutes(5)) }}"
                                             class="h-20 w-20 object-cover rounded-lg border">
                                        <p id="picture-preview-label" class="text-xs text-gray-500 mt-1">Current photo</p>
                                        @else
                                        <img id="picture-preview-img" src="" class="h-20 w-20 object-cover rounded-lg border hidden">
                                        <p id="picture-preview-label" class="text-xs text-gray-500 mt-1 hidden"></p>
                                        @endif
                                   </div>
                                   @error('picture')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>

                    {{-- School Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">School Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <label for="school_name" class="block mb-2 text-sm font-medium text-gray-900">School Name</label>
                                   <input type="text" id="school_name" name="school_name"
                                        value="{{ old('school_name', $learner->school_name) }}"
                                        class="bg-gray-50 border @error('school_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="e.g. XYZ Technical School">
                                   @error('school_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label for="school_address" class="block mb-2 text-sm font-medium text-gray-900">School Address</label>
                                   <textarea id="school_address" name="school_address" rows="1"
                                        class="bg-gray-50 border @error('school_address') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Complete school address">{{ old('school_address', $learner->school_address) }}</textarea>
                                   @error('school_address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                         <p class="text-xs text-gray-500 mb-4">
                              <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                   <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                              </svg>
                              Personal information is encrypted and stored securely
                         </p>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Sex</label>
                                   <select name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select sex</option>
                                        <option value="male" @selected(old('sex', $learner->sex) === 'male')>Male</option>
                                        <option value="female" @selected(old('sex', $learner->sex) === 'female')>Female</option>
                                   </select>
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Civil Status</label>
                                   <select name="civil_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select civil status</option>
                                        <option value="single" @selected(old('civil_status', $learner->civil_status) === 'single')>Single</option>
                                        <option value="married" @selected(old('civil_status', $learner->civil_status) === 'married')>Married</option>
                                        <option value="widow" @selected(old('civil_status', $learner->civil_status) === 'widow')>Widow</option>
                                        <option value="separated" @selected(old('civil_status', $learner->civil_status) === 'separated')>Separated</option>
                                   </select>
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Date of Birth</label>
                                   <input type="date" name="birth_date"
                                        value="{{ old('birth_date', $learner->birth_date) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Place of Birth</label>
                                   <input type="text" name="birth_place"
                                        value="{{ old('birth_place', $learner->birth_place) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="City/Municipality, Province">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Mother's Name</label>
                                   <input type="text" name="mother_name"
                                        value="{{ old('mother_name', $learner->mother_name) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Full name">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Father's Name</label>
                                   <input type="text" name="father_name"
                                        value="{{ old('father_name', $learner->father_name) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Full name">
                              </div>
                         </div>
                    </div>

                    {{-- Address Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                              <div class="md:col-span-3">
                                   <label class="block mb-2 text-sm font-medium text-gray-900">House/Block/Lot No., Street</label>
                                   <input type="text" name="address_number_street"
                                        value="{{ old('address_number_street', $learner->address_number_street) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="e.g. Block 5 Lot 12, Main Street">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                   <input type="text" name="address_barangay" value="{{ old('address_barangay', $learner->address_barangay) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Barangay name">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">District</label>
                                   <input type="text" name="address_district" value="{{ old('address_district', $learner->address_district) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="District">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">City/Municipality</label>
                                   <input type="text" name="address_city" value="{{ old('address_city', $learner->address_city) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Province</label>
                                   <input type="text" name="address_province" value="{{ old('address_province', $learner->address_province) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Province">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Region</label>
                                   <input type="text" name="address_region" value="{{ old('address_region', $learner->address_region) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Region">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">ZIP Code</label>
                                   <input type="text" name="address_zip_code" maxlength="10" value="{{ old('address_zip_code', $learner->address_zip_code) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ZIP Code">
                              </div>
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Mobile Number</label>
                                   <input type="tel" name="contact_mobile" value="{{ old('contact_mobile', $learner->contact_mobile) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. +639123456789">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Telephone</label>
                                   <input type="tel" name="contact_tel" value="{{ old('contact_tel', $learner->contact_tel) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. (02) 1234-5678">
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                                   <input type="email" name="contact_email" value="{{ old('contact_email', $learner->contact_email ?? $learner->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@example.com">
                                   @error('contact_email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Fax Number</label>
                                   <input type="tel" name="contact_fax" value="{{ old('contact_fax', $learner->contact_fax) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Fax number">
                              </div>
                              <div class="md:col-span-2">
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Other Contact Information</label>
                                   <input type="text" name="contact_others" value="{{ old('contact_others', $learner->contact_others) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Other contact details">
                              </div>
                         </div>
                    </div>

                    {{-- Educational Background --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Educational Background</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Highest Educational Attainment</label>
                                   <select name="educational_attainment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select educational attainment</option>
                                        <option value="elementary_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'elementary_graduate')>Elementary Graduate</option>
                                        <option value="high_school_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'high_school_graduate')>High School Graduate</option>
                                        <option value="tvet_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'tvet_graduate')>TVET Graduate</option>
                                        <option value="college_level" @selected(old('educational_attainment', $learner->educational_attainment) === 'college_level')>College Level</option>
                                        <option value="college_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'college_graduate')>College Graduate</option>
                                        <option value="others" @selected(old('educational_attainment', $learner->educational_attainment) === 'others')>Others</option>
                                   </select>
                              </div>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">If Others, Please Specify</label>
                                   <input type="text" name="educational_attainment_others"
                                        value="{{ old('educational_attainment_others', $learner->educational_attainment_others) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Specify other educational attainment">
                              </div>
                         </div>
                    </div>

                    {{-- Employment Information --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h2>
                         <div>
                              <label class="block mb-2 text-sm font-medium text-gray-900">Employment Status</label>
                              <select name="employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   <option value="">Select employment status</option>
                                   <option value="casual" @selected(old('employment_status', $learner->employment_status) === 'casual')>Casual</option>
                                   <option value="job_order" @selected(old('employment_status', $learner->employment_status) === 'job_order')>Job Order</option>
                                   <option value="probationary" @selected(old('employment_status', $learner->employment_status) === 'probationary')>Probationary</option>
                                   <option value="permanent" @selected(old('employment_status', $learner->employment_status) === 'permanent')>Permanent</option>
                                   <option value="self_employed" @selected(old('employment_status', $learner->employment_status) === 'self_employed')>Self-Employed</option>
                                   <option value="ofw" @selected(old('employment_status', $learner->employment_status) === 'ofw')>OFW</option>
                              </select>
                         </div>
                    </div>

                    {{-- Work Experiences --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-lg font-semibold text-gray-900">Work Experiences</h2>
                              <button type="button" onclick="addWorkExperience()"
                                   class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                   + Add Work Experience
                              </button>
                         </div>
                         <div id="work-experiences-container" data-count="{{ count($workExperiences) }}" class="space-y-3">
                              @forelse($workExperiences as $index => $experience)
                              <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 work-experience-item">
                                   <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-900">Work Experience #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')"
                                             class="text-red-600 hover:text-red-800">
                                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <input type="text" name="work_experiences[{{ $index }}][company]" value="{{ $experience['company'] ?? '' }}" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="work_experiences[{{ $index }}][position]" value="{{ $experience['position'] ?? '' }}" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="work_experiences[{{ $index }}][duration]" value="{{ $experience['duration'] ?? '' }}" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <textarea name="work_experiences[{{ $index }}][responsibilities]" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $experience['responsibilities'] ?? '' }}</textarea>
                                   </div>
                              </div>
                              @empty
                              <p class="text-sm text-gray-500 text-center py-4 empty-notice">No work experiences added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Trainings --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-lg font-semibold text-gray-900">Training/Seminars Attended</h2>
                              <button type="button" onclick="addTraining()"
                                   class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                   + Add Training
                              </button>
                         </div>
                         <div id="trainings-container" data-count="{{ count($trainings) }}" class="space-y-3">
                              @forelse($trainings as $index => $training)
                              <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 training-item">
                                   <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-900">Training #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')"
                                             class="text-red-600 hover:text-red-800">
                                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <input type="text" name="trainings[{{ $index }}][title]" value="{{ $training['title'] ?? '' }}" placeholder="Training Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="trainings[{{ $index }}][provider]" value="{{ $training['provider'] ?? '' }}" placeholder="Training Provider" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="trainings[{{ $index }}][date]" value="{{ $training['date'] ?? '' }}" placeholder="Date (e.g., January 2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="trainings[{{ $index }}][hours]" value="{{ $training['hours'] ?? '' }}" placeholder="Number of Hours" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   </div>
                              </div>
                              @empty
                              <p class="text-sm text-gray-500 text-center py-4 empty-notice">No trainings added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Licensure Examinations --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-lg font-semibold text-gray-900">Licensure Examinations</h2>
                              <button type="button" onclick="addLicensure()"
                                   class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                   + Add Licensure
                              </button>
                         </div>
                         <div id="licensure-container" data-count="{{ count($licensureExamination) }}" class="space-y-3">
                              @forelse($licensureExamination as $index => $licensure)
                              <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 licensure-item">
                                   <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-900">Licensure #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')"
                                             class="text-red-600 hover:text-red-800">
                                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <input type="text" name="licensure_examination[{{ $index }}][title]" value="{{ $licensure['title'] ?? '' }}" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="licensure_examination[{{ $index }}][license_number]" value="{{ $licensure['license_number'] ?? '' }}" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="licensure_examination[{{ $index }}][date_taken]" value="{{ $licensure['date_taken'] ?? '' }}" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="licensure_examination[{{ $index }}][validity]" value="{{ $licensure['validity'] ?? '' }}" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   </div>
                              </div>
                              @empty
                              <p class="text-sm text-gray-500 text-center py-4 empty-notice">No licensure examinations added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Competency Assessments --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-lg font-semibold text-gray-900">Competency Assessments</h2>
                              <button type="button" onclick="addCompetency()"
                                   class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                   + Add Assessment
                              </button>
                         </div>
                         <div id="competency-container" data-count="{{ count($competencyAssessment) }}" class="space-y-3">
                              @forelse($competencyAssessment as $index => $competency)
                              <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 competency-item">
                                   <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-900">Assessment #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')"
                                             class="text-red-600 hover:text-red-800">
                                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <input type="text" name="competency_assessment[{{ $index }}][qualification]" value="{{ $competency['qualification'] ?? '' }}" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="competency_assessment[{{ $index }}][certificate_number]" value="{{ $competency['certificate_number'] ?? '' }}" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="competency_assessment[{{ $index }}][date_issued]" value="{{ $competency['date_issued'] ?? '' }}" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <input type="text" name="competency_assessment[{{ $index }}][expiry_date]" value="{{ $competency['expiry_date'] ?? '' }}" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   </div>
                              </div>
                              @empty
                              <p class="text-sm text-gray-500 text-center py-4 empty-notice">No competency assessments added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Documents --}}
                    <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                         <div class="flex items-center justify-between mb-4">
                              <h2 class="text-lg font-semibold text-gray-900">Documents</h2>
                              <button type="button" onclick="addDocument()"
                                   class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                   + Add Document
                              </button>
                         </div>
                         <div id="documents-container" data-count="{{ count($documents) }}" class="space-y-3">
                              @forelse($documents as $index => $document)
                              <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 document-item" data-doc-id="{{ $document['id'] }}">
                                   <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-900">Document #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">
                                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>
                                   <div class="grid grid-cols-2 gap-3">
                                        <input type="hidden" name="documents[{{ $index }}][id]" value="{{ $document['id'] }}">
                                        <select name="documents[{{ $index }}][type]"
                                             class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select document type</option>
                                             @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                                             <option value="{{ $type->value }}" @selected($document['type']===$type->value)>
                                                  {{ str_replace('_', ' ', $type->name) }}
                                             </option>
                                             @endforeach
                                        </select>
                                        <input type="file" name="documents[{{ $index }}][file]"
                                             class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                        @if(!empty($document['file']))
                                        <div class="col-span-2 flex items-center gap-2">
                                             <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                             </svg>
                                             <a href="{{ Storage::disk('s3')->temporaryUrl($document['file'], now()->addMinute(1)) }}"
                                                  target="_blank" class="text-sm text-blue-600 hover:underline truncate">
                                                  {{ basename($document['file']) }}
                                             </a>
                                        </div>
                                        @endif
                                   </div>
                              </div>
                              @empty
                              <p class="text-sm text-gray-500 text-center py-4 empty-notice">No documents added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Terms and Conditions --}}
                    <div class="p-4 md:p-5 border-b border-gray-200">
                         <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                              <div class="flex items-start gap-3">
                                   <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.955 11.955 0 003 10c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                                        </svg>
                                   </div>
                                   <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-gray-800 mb-1">Certification & Agreement</h4>
                                        <p class="text-xs text-gray-500 leading-relaxed mb-4">
                                             I hereby certify that the information provided above is true and correct to the best of my knowledge.
                                             I understand that any false statement or misrepresentation may result in the revocation of my TESDA
                                             accreditation or disqualification from training and assessment activities.
                                        </p>
                                        <label class="flex items-start gap-3 cursor-pointer group">
                                             <div class="relative flex-shrink-0 mt-0.5">
                                                  <input type="checkbox" name="agreedToTerms" value="1"
                                                       {{ old('agreedToTerms', $learner->agreed_to_terms) ? 'checked' : '' }}
                                                       class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2 cursor-pointer">
                                             </div>
                                             <span class="text-xs text-gray-600 group-hover:text-gray-800 transition-colors leading-relaxed">
                                                  I have read, understood, and agree to the above certification statement and
                                                  <a href="{{ route('data.privacy') }}" class="text-blue-500 underline">data privacy</a>
                                                  <span class="text-red-500 ml-0.5">*</span>
                                             </span>
                                        </label>
                                        @error('agreedToTerms')
                                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                             <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                             </svg>
                                             {{ $message }}
                                        </p>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                         <button type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                              Update Student Profile Details
                         </button>
                    </div>

               </form>
          </div>
     </div>

     <script>
          // Read counters from data attributes — no Blade needed inside JS
          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);

          const removeIconSvg = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
    </svg>`;

          // ─── Shared helpers ──────────────────────────────────────────────────────────
          function removeEmptyNotice(containerId) {
               const container = document.getElementById(containerId);
               const notice = container.querySelector('.empty-notice');
               if (notice) notice.remove();
          }

          function addEmptyNoticeIfEmpty(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);
               if (container.querySelectorAll(itemSelector).length === 0) {
                    const p = document.createElement('p');
                    p.className = 'text-sm text-gray-500 text-center py-4 empty-notice';
                    p.textContent = `No ${label.toLowerCase()} added yet.`;
                    container.appendChild(p);
               }
          }

          function renumberItems(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);
               container.querySelectorAll(itemSelector).forEach((el, i) => {
                    const num = el.querySelector('.item-number');
                    if (num) num.textContent = i + 1;
               });
          }

          // Generic remove for non-document sections (no S3 deletion needed)
          function removeItem(btn, containerId, itemSelector, label) {
               if (!confirm(`Remove this ${label}?`)) return;
               btn.closest(itemSelector).remove();
               renumberItems(containerId, itemSelector, label);
               addEmptyNoticeIfEmpty(containerId, itemSelector, label);
               reindexInputs(containerId, itemSelector);
          }

          // Re-index all name attributes after removal so array keys stay sequential
          function reindexInputs(containerId, itemSelector) {
               const container = document.getElementById(containerId);
               container.querySelectorAll(itemSelector).forEach((el, i) => {
                    el.querySelectorAll('[name]').forEach(input => {
                         input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
                    });
               });
          }

          // ─── Picture preview ─────────────────────────────────────────────────────────
          function previewPicture(input) {
               if (!input.files || !input.files[0]) return;
               const reader = new FileReader();
               reader.onload = e => {
                    const preview = document.getElementById('picture-preview');
                    const img = document.getElementById('picture-preview-img');
                    const label = document.getElementById('picture-preview-label');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    label.textContent = 'New photo selected';
                    label.classList.remove('hidden');
                    preview.classList.remove('hidden');
               };
               reader.readAsDataURL(input.files[0]);
          }

          // ─── Work Experiences ────────────────────────────────────────────────────────
          function addWorkExperience() {
               removeEmptyNotice('work-experiences-container');
               const i = workExpCount++;
               const html = `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 work-experience-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Work Experience #<span class="item-number">${document.querySelectorAll('.work-experience-item').length + 1}</span></h4>
                         <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                         <input type="text" name="work_experiences[${i}][company]" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="work_experiences[${i}][position]" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="work_experiences[${i}][duration]" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <textarea name="work_experiences[${i}][responsibilities]" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                    </div>
               </div>`;
               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', html);
          }

          // ─── Trainings ───────────────────────────────────────────────────────────────
          function addTraining() {
               removeEmptyNotice('trainings-container');
               const i = trainingCount++;
               const html = `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 training-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Training #<span class="item-number">${document.querySelectorAll('.training-item').length + 1}</span></h4>
                         <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                         <input type="text" name="trainings[${i}][title]" placeholder="Training Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="trainings[${i}][provider]" placeholder="Training Provider" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="trainings[${i}][date]" placeholder="Date (e.g., January 2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="trainings[${i}][hours]" placeholder="Number of Hours" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
               </div>`;
               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', html);
          }

          // ─── Licensure ───────────────────────────────────────────────────────────────
          function addLicensure() {
               removeEmptyNotice('licensure-container');
               const i = licensureCount++;
               const html = `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 licensure-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Licensure #<span class="item-number">${document.querySelectorAll('.licensure-item').length + 1}</span></h4>
                         <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                         <input type="text" name="licensure_examination[${i}][title]" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="licensure_examination[${i}][license_number]" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="licensure_examination[${i}][date_taken]" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="licensure_examination[${i}][validity]" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
               </div>`;
               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', html);
          }

          // ─── Competency ──────────────────────────────────────────────────────────────
          function addCompetency() {
               removeEmptyNotice('competency-container');
               const i = competencyCount++;
               const html = `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 competency-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Assessment #<span class="item-number">${document.querySelectorAll('.competency-item').length + 1}</span></h4>
                         <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                         <input type="text" name="competency_assessment[${i}][qualification]" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][certificate_number]" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][date_issued]" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][expiry_date]" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
               </div>`;
               document.getElementById('competency-container').insertAdjacentHTML('beforeend', html);
          }

          // ─── Documents ───────────────────────────────────────────────────────────────
          // Build the document type <select> options from PHP enum (rendered once)
          const documentTypeOptions = `
               <option value="">Select document type</option>
               @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
               <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
               @endforeach
          `;

          function addDocument() {
               removeEmptyNotice('documents-container');
               const i = documentCount++;
               const num = document.querySelectorAll('.document-item').length + 1;
               const html = `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 document-item" data-doc-id="">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Document #<span class="item-number">${num}</span></h4>
                         <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                         <select name="documents[${i}][type]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                              ${documentTypeOptions}
                         </select>
                         <input type="file" name="documents[${i}][file]"
                              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
               </div>`;
               document.getElementById('documents-container').insertAdjacentHTML('beforeend', html);
          }

          function removeDocument(btn) {
               if (!confirm('Are you sure you want to remove this document? This will permanently delete the file and cannot be undone.')) return;

               const item = btn.closest('.document-item');
               const docId = item.dataset.docId;

               // If existing DB record, track it for deletion on submit
               if (docId) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_document_ids[]';
                    input.value = docId;
                    document.getElementById('deleted-document-ids-container').appendChild(input);
               }

               item.remove();
               renumberItems('documents-container', '.document-item', 'Document');
               addEmptyNoticeIfEmpty('documents-container', '.document-item', 'Documents');
               reindexInputs('documents-container', '.document-item');
          }
     </script>
</x-layouts.app.flowbite>