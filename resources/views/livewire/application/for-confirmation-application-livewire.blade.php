<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <!-- <div>
            <h1 class="text-xl font-semibold text-gray-800">Pending Applicants (For Confimation)</h1>
            <p class="text-sm text-gray-400 mt-0.5">Review and manage all training applications</p>
        </div> -->

        <div class="flex items-start gap-3">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Pending Applicants
                    <span class="ml-1.5 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                        For Confirmation
                    </span>
                </h1>
                <p class="text-sm text-gray-400 mt-0.5">Review and manage all training applications</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search applicants..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>

        </div>
    </div>

    @if(session()->has('success'))
    <div class="mb-6 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="mb-6 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application No.</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant Details</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Course</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Training Center</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Assigned Batch</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Date</th>
                        <!-- <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Application Type</th> -->
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applicants as $applicant)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400 font-medium uppercase">
                            {{ $applicant->application_number }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <!-- <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-indigo-600">
                                        {{ substr($applicant->name, 0, 1) }}{{ substr($applicant->last_name, 0, 1) }}
                                    </span>
                                </div> -->
                                <div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $applicant->full_name_searchable }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $applicant->email }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $applicant->contact_number }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="font-medium text-gray-800">{{ $applicant->course_name }}</div>
                            <div class="text-xs text-gray-500">{{ $applicant->course_code }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            <div class="font-medium">{{ $applicant->center_name }}</div>
                            <div class="text-xs text-gray-500">{{ $applicant->center_code }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            @if($applicant->batch_name)
                            <div class="font-medium">{{ $applicant->batch_name }} - {{ $applicant->batch_code }}</div>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                No batch assigned
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-gray-500 font-mono text-xs">
                            {{ date('M d, Y', strtotime($applicant->application_date)) }}
                        </td>

                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('learner-training-applications.review.application', ['userUuid' => $applicant->uuid]) }}"
                                    class="inline-flex items-center gap-1 text-indigo-500 hover:text-indigo-700 font-medium text-sm transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Review
                                </a>
                                <span class="text-gray-300">|</span>
                                <button wire:click.prevent="approveApplication({{ $applicant->id }})" wire:confirm="Are you sure you want to approve this application?"
                                    class="inline-flex items-center gap-1 text-green-500 hover:text-green-700 font-medium text-sm transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Approve Application
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center">
                            <svg class="mx-auto w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <p class="mt-4 text-sm font-medium text-gray-500">No applicants found</p>
                            <p class="mt-1 text-xs text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($applicants->hasPages())
    <div class="mt-4">
        {{ $applicants->links() }}
    </div>
    @endif
</div>