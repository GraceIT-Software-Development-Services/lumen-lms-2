<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Training Schedule Item Update
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Update the details of the training schedule item
                         </p>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif

               <form id="update-schedule-item-form" action="{{ route('training_schedule_items.update', $trainingScheduleItem->uuid) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Name --}}
                              <div class="md:col-span-2">
                                   <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Schedule Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $trainingScheduleItem->name) }}"
                                        class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="e.g. Morning Training Session">
                                   @error('name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Description --}}
                              <div class="md:col-span-2">
                                   <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                        Description
                                   </label>
                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="3"
                                        class="bg-gray-50 border @error('description') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Optional description">{{ old('description', $trainingScheduleItem->description) }}</textarea>
                                   @error('description')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Schedule Days --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Schedule Days</h2>

                         @php
                         $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                         $oldDays = old('schedule_days', $trainingScheduleItem->schedule_days ?? []);
                         @endphp

                         <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                              @foreach ($days as $day)
                              <label class="flex items-center space-x-2">
                                   <input
                                        type="checkbox"
                                        name="schedule_days[]"
                                        value="{{ $day }}"
                                        {{ in_array($day, $oldDays) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                   <span class="text-sm text-gray-700">{{ $day }}</span>
                              </label>
                              @endforeach
                         </div>

                         @error('schedule_days')
                         <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                         @enderror
                    </div>

                    {{-- Time --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Session Time</h2>

                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Start Time --}}
                              <div>
                                   <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900">
                                        Start Time <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="time"
                                        id="start_time"
                                        name="start_time"
                                        value="{{ old('start_time', date('H:i', strtotime($trainingScheduleItem->start_time))) }}"
                                        class="bg-gray-50 border @error('start_time') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   @error('start_time')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- End Time --}}
                              <div>
                                   <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">
                                        End Time <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="time"
                                        id="end_time"
                                        name="end_time"
                                        value="{{ old('end_time', date('H:i', strtotime($trainingScheduleItem->end_time))) }}"
                                        class="bg-gray-50 border @error('end_time') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   @error('end_time')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Update Schedule
                         </button>
                         <button
                              type="button"
                              onclick="confirmDelete()"
                              class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-3 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                              Delete Schedule
                         </button>

                         <a href="{{ route('training_schedule_items.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-schedule-item-form" action="{{ route('training_schedule_items.destroy', $trainingScheduleItem->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     {{-- Delete Confirmation Script --}}
     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training schedule item? This action cannot be undone.')) {
                    document.getElementById('delete-schedule-item-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>