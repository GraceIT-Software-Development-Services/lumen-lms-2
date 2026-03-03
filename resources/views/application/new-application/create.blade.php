<x-layouts.app.flowbite>

     <div>
          <div class="max-w-full mx-auto">
               <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

                    {{-- Header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                         <div>
                              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">New Learner Registration</h3>
                              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Complete all required fields to register a new learner</p>
                         </div>
                    </div>

                    {{-- Flash Messages --}}
                    @if(session('success'))
                    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg" role="alert">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('learner-applications.store') }}" method="POST" enctype="multipart/form-data">
                         @csrf

                         {{-- ULI --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Unique Learner Identifier</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Unique Learner Identifier <span class="text-red-500">*</span></label>
                                        <input type="text" name="uli" value="{{ old('uli') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('uli') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter ULI">
                                        @error('uli')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                              </div>
                         </div>

                         {{-- Basic Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">First Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="firstName" value="{{ old('firstName') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('firstName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter first name">
                                        @error('firstName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Middle Name</label>
                                        <input type="text" name="middleName" value="{{ old('middleName') }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter middle name">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Last Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="lastName" value="{{ old('lastName') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('lastName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter last name">
                                        @error('lastName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Suffix</label>
                                        <input type="text" name="suffix" value="{{ old('suffix') }}" maxlength="10" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Jr., Sr., III, etc.">
                                   </div>
                              </div>
                         </div>

                         {{-- Other Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Other Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Client Type</label>
                                        <select name="clientType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select client type</option>
                                             <option value="tvet_graduating_student" @selected(old('clientType')==='tvet_graduating_student' )>TVET Graduating Student</option>
                                             <option value="tvet_graduate" @selected(old('clientType')==='tvet_graduate' )>TVET Graduate</option>
                                             <option value="industry_worker" @selected(old('clientType')==='industry_worker' )>Industry Worker</option>
                                             <option value="k12" @selected(old('clientType')==='k12' )>K12</option>
                                             <option value="owf" @selected(old('clientType')==='owf' )>OWF</option>
                                        </select>
                                   </div>
                                   <div class="md:col-span-3">
                                        <label for="picture" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>
                                        <input type="file" id="picture" name="picture" accept="image/*"
                                             class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                             onchange="previewPicture(this)">
                                        <div id="picture-preview" class="mt-2 hidden">
                                             <img id="picture-preview-img" src="" class="h-20 w-20 object-cover rounded-lg border">
                                             <p class="text-xs text-gray-500 mt-1">New photo selected</p>
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
                                        <label class="block mb-2 text-sm font-medium text-gray-900">School Name</label>
                                        <input type="text" name="schoolName" value="{{ old('schoolName') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('schoolName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. XYZ Technical School">
                                        @error('schoolName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">School Address</label>
                                        <textarea name="schoolAddress" rows="1" autocomplete="off"
                                             class="bg-gray-50 border @error('schoolAddress') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Complete school address">{{ old('schoolAddress') }}</textarea>
                                        @error('schoolAddress')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
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
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Sex <span class="text-red-500">*</span></label>
                                        <select name="sex" class="bg-gray-50 border @error('sex') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select sex</option>
                                             <option value="male" @selected(old('sex')==='male' )>Male</option>
                                             <option value="female" @selected(old('sex')==='female' )>Female</option>
                                        </select>
                                        @error('sex')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Civil Status <span class="text-red-500">*</span></label>
                                        <select name="civilStatus" class="bg-gray-50 border @error('civilStatus') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select civil status</option>
                                             <option value="single" @selected(old('civilStatus')==='single' )>Single</option>
                                             <option value="married" @selected(old('civilStatus')==='married' )>Married</option>
                                             <option value="widow" @selected(old('civilStatus')==='widow' )>Widow</option>
                                             <option value="separated" @selected(old('civilStatus')==='separated' )>Separated</option>
                                        </select>
                                        @error('civilStatus')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Date of Birth <span class="text-red-500">*</span></label>
                                        <input type="date" name="birthDate" value="{{ old('birthDate') }}"
                                             class="bg-gray-50 border @error('birthDate') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error('birthDate')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Place of Birth</label>
                                        <input type="text" name="birthPlace" value="{{ old('birthPlace') }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="City/Municipality, Province">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Mother's Name</label>
                                        <input type="text" name="motherName" value="{{ old('motherName') }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Full name">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Father's Name</label>
                                        <input type="text" name="fatherName" value="{{ old('fatherName') }}" autocomplete="off"
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
                                        <input type="text" name="addressNumberStreet" value="{{ old('addressNumberStreet') }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. Block 5 Lot 12, Main Street">
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Barangay</label><input type="text" name="addressBarangay" value="{{ old('addressBarangay') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Barangay name"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">District</label><input type="text" name="addressDistrict" value="{{ old('addressDistrict') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="District"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">City/Municipality</label><input type="text" name="addressCity" value="{{ old('addressCity') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Province</label><input type="text" name="addressProvince" value="{{ old('addressProvince') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Province"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Region</label><input type="text" name="addressRegion" value="{{ old('addressRegion') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Region"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">ZIP Code</label><input type="text" name="addressZipCode" value="{{ old('addressZipCode') }}" maxlength="10" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ZIP Code"></div>
                              </div>
                         </div>

                         {{-- Contact Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Mobile Number <span class="text-red-500">*</span></label>
                                        <input type="tel" name="contactMobile" value="{{ old('contactMobile') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('contactMobile') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. +639123456789">
                                        @error('contactMobile')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Telephone</label><input type="tel" name="contactTel" value="{{ old('contactTel') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. (02) 1234-5678"></div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                                        <input type="email" name="contactEmail" value="{{ old('contactEmail') }}" autocomplete="off"
                                             class="bg-gray-50 border @error('contactEmail') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="email@example.com">
                                        @error('contactEmail')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Fax Number</label><input type="tel" name="contactFax" value="{{ old('contactFax') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Fax number"></div>
                                   <div class="md:col-span-2"><label class="block mb-2 text-sm font-medium text-gray-900">Other Contact Information</label><input type="text" name="contactOthers" value="{{ old('contactOthers') }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Other contact details"></div>
                              </div>
                         </div>

                         {{-- Educational Background --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Educational Background</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Highest Educational Attainment</label>
                                        <select name="educationalAttainment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select educational attainment</option>
                                             <option value="elementary_graduate" @selected(old('educationalAttainment')==='elementary_graduate' )>Elementary Graduate</option>
                                             <option value="high_school_graduate" @selected(old('educationalAttainment')==='high_school_graduate' )>High School Graduate</option>
                                             <option value="tvet_graduate" @selected(old('educationalAttainment')==='tvet_graduate' )>TVET Graduate</option>
                                             <option value="college_level" @selected(old('educationalAttainment')==='college_level' )>College Level</option>
                                             <option value="college_graduate" @selected(old('educationalAttainment')==='college_graduate' )>College Graduate</option>
                                             <option value="others" @selected(old('educationalAttainment')==='others' )>Others</option>
                                        </select>
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">If Others, Please Specify</label><input type="text" name="educationalAttainmentOthers" value="{{ old('educationalAttainmentOthers') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Specify other educational attainment"></div>
                              </div>
                         </div>

                         {{-- Employment Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h2>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Employment Status</label>
                                   <select name="employmentStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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

                         {{-- Work Experiences --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Work Experiences</h2>
                                   <button type="button" onclick="addWorkExperience()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Work Experience</button>
                              </div>
                              <div id="work-experiences-container" data-count="0" class="space-y-3">
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No work experiences added yet.</p>
                              </div>
                         </div>

                         {{-- Trainings --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Training/Seminars Attended</h2>
                                   <button type="button" onclick="addTraining()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Training</button>
                              </div>
                              <div id="trainings-container" data-count="0" class="space-y-3">
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No trainings added yet.</p>
                              </div>
                         </div>

                         {{-- Licensure Examinations --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Licensure Examinations</h2>
                                   <button type="button" onclick="addLicensure()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Licensure</button>
                              </div>
                              <div id="licensure-container" data-count="0" class="space-y-3">
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No licensure examinations added yet.</p>
                              </div>
                         </div>

                         {{-- Competency Assessments --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Competency Assessments</h2>
                                   <button type="button" onclick="addCompetency()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Assessment</button>
                              </div>
                              <div id="competency-container" data-count="0" class="space-y-3">
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No competency assessments added yet.</p>
                              </div>
                         </div>

                         {{-- Documents --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Documents</h2>
                                   <button type="button" onclick="addDocument()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Document</button>
                              </div>
                              <div id="documents-container" data-count="0" class="space-y-3">
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No documents added yet.</p>
                              </div>
                         </div>

                         {{-- Training Course and Batch Assignment --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Training Course and Batch Assignment</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                   {{-- Training Course --}}
                                   <div class="md:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Training Course <span class="text-red-500">*</span></label>
                                        <select name="courseId" id="courseId" onchange="loadCenters(this.value)"
                                             class="bg-gray-50 border @error('courseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select training course</option>
                                             @foreach ($courses as $course)
                                             <option value="{{ $course->id }}" @selected(old('courseId')==$course->id)>
                                                  {{ $course->course_name }} - {{ $course->course_code }}
                                             </option>
                                             @endforeach
                                        </select>
                                        @error('courseId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>

                                   {{-- Training Center --}}
                                   <div class="md:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Training Center <span class="text-red-500">*</span></label>
                                        <select name="centerId" id="centerId" onchange="loadBatches()" disabled
                                             class="bg-gray-50 border @error('centerId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                                             <option value="">Select a course first</option>
                                        </select>
                                        @error('centerId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>

                                   {{-- Training Batch --}}
                                   <div class="md:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Student Training Batch <span class="text-red-500">*</span></label>
                                        <select name="batchId" id="batchId" disabled
                                             class="bg-gray-50 border @error('batchId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                                             <option value="">Select a center first</option>
                                        </select>
                                        @error('batchId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
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
                                                       <input type="checkbox" name="agreedToTerms" value="1" {{ old('agreedToTerms') ? 'checked' : '' }}
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
                              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center gap-2">
                                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                   </svg>
                                   Register new applicants
                              </button>
                              <a href="{{ route('learner-training-applications.index') }}"
                                   class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
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

     <script>
          // ─── Read counters from data-count attributes ─────────────────────────────
          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);

          const removeIconSvg = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
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
                    p.className = 'text-sm text-gray-500 text-center py-4 empty-notice';
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
               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', `
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
               </div>`);
          }

          // ─── Trainings ────────────────────────────────────────────────────────────
          function addTraining() {
               removeEmptyNotice('trainings-container');
               const i = trainingCount++;
               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', `
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
               </div>`);
          }

          // ─── Licensure ────────────────────────────────────────────────────────────
          function addLicensure() {
               removeEmptyNotice('licensure-container');
               const i = licensureCount++;
               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', `
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
               </div>`);
          }

          // ─── Competency ───────────────────────────────────────────────────────────
          function addCompetency() {
               removeEmptyNotice('competency-container');
               const i = competencyCount++;
               document.getElementById('competency-container').insertAdjacentHTML('beforeend', `
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
               document.getElementById('documents-container').insertAdjacentHTML('beforeend', `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 document-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Document #<span class="item-number">${document.querySelectorAll('.document-item').length + 1}</span></h4>
                         <button type="button" onclick="removeItem(this,'documents-container','.document-item','Document')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                         <select name="documents[${i}][type]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                              ${documentTypeOptions}
                         </select>
                         <input type="file" name="documents[${i}][file]"
                              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
               </div>`);
          }

          // ─── Cascading dropdowns (Course → Center → Batch) ────────────────────────
          function loadCenters(courseId) {
               const centerSelect = document.getElementById('centerId');
               const batchSelect = document.getElementById('batchId');

               // Reset downstream
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
                              batchSelect.insertAdjacentHTML('beforeend',
                                   `<option value="${b.id}">${b.batch_name} • ${b.batch_code} • (${start} – ${end})</option>`
                              );
                         });
                         batchSelect.disabled = false;
                    });
          }
     </script>
</x-layouts.app.flowbite>