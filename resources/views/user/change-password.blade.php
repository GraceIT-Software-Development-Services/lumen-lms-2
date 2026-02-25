<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm">

               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 bg-blue-50">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900">Change Password</h3>
                         <p class="text-sm text-gray-600 mt-1">Update your account password to keep your account secure</p>
                    </div>
               </div>

               @if(session()->has('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900 dark:text-green-200" role="alert">
                    <div class="flex items-center">
                         <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                         </svg>
                         {{ session('success') }}
                    </div>
               </div>
               @endif

               @if(session()->has('error'))
               <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-200" role="alert">
                    <div class="flex items-center">
                         <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                         </svg>
                         {{ session('error') }}
                    </div>
               </div>
               @endif

               <form action="{{ route('users-update-password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Success Message --}}
                    @if(session('status') === 'password-updated')
                    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg flex items-center gap-2">
                         <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                         </svg>
                         Password updated successfully.
                    </div>
                    @endif

                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Password Information</h2>

                         <div class="grid grid-cols-1 gap-4 max-w-lg">

                              {{-- Current Password --}}
                              <div>
                                   <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900">
                                        Current Password <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="current_password"
                                        name="current_password"
                                        autocomplete="current-password"
                                        class="bg-gray-50 border @error('current_password') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter your current password">
                                   @error('current_password')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- New Password --}}
                              <div>
                                   <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                        New Password <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        autocomplete="new-password"
                                        class="bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter new password">
                                   @error('password')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Confirm Password --}}
                              <div>
                                   <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                                        Confirm New Password <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        autocomplete="new-password"
                                        class="bg-gray-50 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Re-enter new password">
                                   @error('password_confirmation')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Password Requirements --}}
                              <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                   <p class="text-xs font-medium text-gray-600 mb-2">Password requirements:</p>
                                   <ul class="space-y-1">
                                        <li class="flex items-center gap-1.5 text-xs text-gray-500">
                                             <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                             </svg>
                                             At least 8 characters long
                                        </li>
                                        <li class="flex items-center gap-1.5 text-xs text-gray-500">
                                             <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                             </svg>
                                             Contains uppercase and lowercase letters
                                        </li>
                                        <li class="flex items-center gap-1.5 text-xs text-gray-500">
                                             <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                             </svg>
                                             Contains at least one number or special character
                                        </li>
                                   </ul>
                              </div>

                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                         <button
                              type="submit"
                              class="inline-flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                              </svg>
                              Update Password
                         </button>
                    </div>

               </form>
          </div>
     </div>

</x-layouts.app.flowbite>