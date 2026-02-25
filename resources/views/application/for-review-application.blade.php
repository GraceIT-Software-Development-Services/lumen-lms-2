<x-layouts.app.flowbite>
     <div>
          <div class="max-w-full mx-auto">
               <div class="relative bg-white rounded-lg shadow-sm">

                    {{-- Header --}}
                    <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-blue-50">
                         <div>
                              <h3 class="text-xl font-semibold text-gray-900">Learner Application & Enrollment</h3>
                              <p class="text-sm text-gray-500 mt-1">Viewing learner details</p>
                         </div>
                         <a href="{{ route('learner-training-applications.for.confirmation') }}"
                              class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                              </svg>
                              Back to List
                         </a>
                    </div>

                    {{-- Helper --}}
                    @php
                    function displayValue($value, $fallback = 'N/A') {
                    return $value ? $value : $fallback;
                    }
                    @endphp

                    {{-- ULI --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Unique Learner Identifier</h2>
                         <p class="text-base font-semibold text-gray-900">{{ displayValue($uli) }}</p>
                    </div>

                    {{-- Basic Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Basic Information</h2>
                         <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">First Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($firstName) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Middle Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($middleName) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Last Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($lastName) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Suffix</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($suffix) }}</p>
                              </div>
                         </div>
                    </div>

                    {{-- Other Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Other Information</h2>
                         <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Client Type</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue(str_replace('_', ' ', ucfirst($clientType ?? ''))) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Profile Picture</p>
                                   @if($currentPicturePath)
                                   <img src="{{ Storage::url($currentPicturePath) }}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                                   @else
                                   <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                   </div>
                                   @endif
                              </div>
                         </div>
                    </div>

                    {{-- School Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">School Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">School Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($schoolName) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">School Address</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($schoolAddress) }}</p>
                              </div>
                         </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Personal Information</h2>
                         <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Sex</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue(ucfirst($sex ?? '')) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Civil Status</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue(ucfirst($civilStatus ?? '')) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Date of Birth</p>
                                   <p class="text-sm font-medium text-gray-800">{{ $birthDate ? \Carbon\Carbon::parse($birthDate)->format('F d, Y') : '—' }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Place of Birth</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($birthPlace) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Mother's Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($motherName) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Father's Name</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($fatherName) }}</p>
                              </div>
                         </div>
                    </div>

                    {{-- Address Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Address Information</h2>
                         <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div class="md:col-span-3">
                                   <p class="text-xs text-gray-400 mb-1">House/Block/Lot No., Street</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressNumberStreet) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Barangay</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressBarangay) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">District</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressDistrict) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">City/Municipality</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressCity) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Province</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressProvince) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Region</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressRegion) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">ZIP Code</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($addressZipCode) }}</p>
                              </div>
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Contact Information</h2>
                         <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Mobile Number</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($contactMobile) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Telephone</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($contactTel) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Email Address</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($contactEmail) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Fax Number</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($contactFax) }}</p>
                              </div>
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Other Contact</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($contactOthers) }}</p>
                              </div>
                         </div>
                    </div>

                    {{-- Educational Background --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Educational Background</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Highest Educational Attainment</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue(str_replace('_', ' ', ucfirst($educationalAttainment ?? ''))) }}</p>
                              </div>
                              @if($educationalAttainment === 'others')
                              <div>
                                   <p class="text-xs text-gray-400 mb-1">Specified Attainment</p>
                                   <p class="text-sm font-medium text-gray-800">{{ displayValue($educationalAttainmentOthers) }}</p>
                              </div>
                              @endif
                         </div>
                    </div>

                    {{-- Employment Information --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Employment Information</h2>
                         <div>
                              <p class="text-xs text-gray-400 mb-1">Employment Status</p>
                              <p class="text-sm font-medium text-gray-800">{{ displayValue(str_replace('_', ' ', ucfirst($employmentStatus ?? ''))) }}</p>
                         </div>
                    </div>

                    {{-- Work Experiences --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Work Experiences</h2>
                         @forelse($workExperiences as $index => $experience)
                         <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200" wire:key="work-exp-{{ $index }}">
                              <p class="text-xs font-semibold text-gray-500 mb-2">Work Experience #{{ $index + 1 }}</p>
                              <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Company</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($experience['company'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Position</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($experience['position'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Duration</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($experience['duration'] ?? '') }}</p>
                                   </div>
                                   <div class="md:col-span-3">
                                        <p class="text-xs text-gray-400 mb-1">Responsibilities</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($experience['responsibilities'] ?? '') }}</p>
                                   </div>
                              </div>
                         </div>
                         @empty
                         <p class="text-sm text-gray-400 text-center py-4">No work experiences recorded.</p>
                         @endforelse
                    </div>

                    {{-- Trainings --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Training/Seminars Attended</h2>
                         @forelse($trainings as $index => $training)
                         <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200" wire:key="training-{{ $index }}">
                              <p class="text-xs font-semibold text-gray-500 mb-2">Training #{{ $index + 1 }}</p>
                              <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Title</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($training['title'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Provider</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($training['provider'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Date</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($training['date'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Hours</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($training['hours'] ?? '') }}</p>
                                   </div>
                              </div>
                         </div>
                         @empty
                         <p class="text-sm text-gray-400 text-center py-4">No trainings recorded.</p>
                         @endforelse
                    </div>

                    {{-- Licensure Examinations --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Licensure Examinations</h2>
                         @forelse($licensureExamination as $index => $licensure)
                         <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200" wire:key="licensure-{{ $index }}">
                              <p class="text-xs font-semibold text-gray-500 mb-2">Licensure #{{ $index + 1 }}</p>
                              <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Title</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($licensure['title'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">License Number</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($licensure['license_number'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Date Taken</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($licensure['date_taken'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Validity</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($licensure['validity'] ?? '') }}</p>
                                   </div>
                              </div>
                         </div>
                         @empty
                         <p class="text-sm text-gray-400 text-center py-4">No licensure examinations recorded.</p>
                         @endforelse
                    </div>

                    {{-- Competency Assessments --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Competency Assessments</h2>
                         @forelse($competencyAssessment as $index => $competency)
                         <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200" wire:key="competency-{{ $index }}">
                              <p class="text-xs font-semibold text-gray-500 mb-2">Assessment #{{ $index + 1 }}</p>
                              <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Qualification</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($competency['qualification'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Certificate Number</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($competency['certificate_number'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Date Issued</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($competency['date_issued'] ?? '') }}</p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Expiry Date</p>
                                        <p class="text-sm font-medium text-gray-800">{{ displayValue($competency['expiry_date'] ?? '') }}</p>
                                   </div>
                              </div>
                         </div>
                         @empty
                         <p class="text-sm text-gray-400 text-center py-4">No competency assessments recorded.</p>
                         @endforelse
                    </div>

                    {{-- Documents --}}
                    <div class="p-5 border-b border-gray-200">
                         <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Documents</h2>
                         @forelse($documents as $index => $document)
                         <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-gray-200" wire:key="document-{{ $index }}">
                              <p class="text-xs font-semibold text-gray-500 mb-2">Document #{{ $index + 1 }}</p>
                              <div class="grid grid-cols-2 gap-3">
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">Document Type</p>
                                        <p class="text-sm font-medium text-gray-800">
                                             {{ $document['type'] ? str_replace('_', ' ', ucfirst($document['type'])) : '—' }}
                                        </p>
                                   </div>
                                   <div>
                                        <p class="text-xs text-gray-400 mb-1">File</p>
                                        @if(isset($document['file']) && is_string($document['file']))
                                        <a href="{{ Storage::disk('s3')->temporaryUrl($document['file'], now()->addMinute(1)) }}"
                                             target="_blank"
                                             class="inline-flex items-center gap-1.5 text-sm text-blue-600 hover:underline">
                                             <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                             </svg>
                                             {{ basename($document['file']) }}
                                        </a>
                                        @else
                                        <p class="text-sm text-gray-400">—</p>
                                        @endif
                                   </div>
                              </div>
                         </div>
                         @empty
                         <p class="text-sm text-gray-400 text-center py-4">No documents recorded.</p>
                         @endforelse
                    </div>

                    {{-- Footer --}}
                    <div class="p-5 flex items-center gap-3">
                         <form action="{{ route('learner-training-applications.confirm.application', $userUuid) }}" method="post"
                              onsubmit="return confirm('Are you sure you want to confirm this application? This action cannot be undone.')">
                              @csrf
                              @method('PUT')
                              <button type="submit"
                                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition">
                                   <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                   </svg>
                                   Confirm Application
                              </button>
                         </form>

                         <a href="{{ route('learner-training-applications.for.confirmation') }}"
                              class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                              </svg>
                              Back to List
                         </a>
                    </div>

               </div>
          </div>
     </div>
</x-layouts.app.flowbite>