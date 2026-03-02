<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Training Schedule Items</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor all training schedule items</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search schedule item..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
            <!-- Create Button -->
            <a href="{{ route('training_schedule_items.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Schedule Item
            </a>
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

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Description</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Schedule Days</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Time</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($scheduleItems as $scheduleItem)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">

                        {{-- # --}}
                        <td class="px-5 py-4 text-xs font-mono text-gray-400">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- Name --}}
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-800 text-sm">{{ $scheduleItem->name }}</div>
                        </td>

                        {{-- Description --}}
                        <td class="px-5 py-4 max-w-xs">
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                {{ $scheduleItem->description ?? '—' }}
                            </p>
                        </td>

                        {{-- Schedule Days --}}
                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($scheduleItem->schedule_days ?? [] as $day)
                                @php
                                $short = strtoupper(substr($day, 0, 3));
                                $colors = [
                                'MON' => 'bg-blue-50 text-blue-600',
                                'TUE' => 'bg-violet-50 text-violet-600',
                                'WED' => 'bg-green-50 text-green-600',
                                'THU' => 'bg-amber-50 text-amber-600',
                                'FRI' => 'bg-rose-50 text-rose-600',
                                'SAT' => 'bg-orange-50 text-orange-600',
                                'SUN' => 'bg-gray-100 text-gray-500',
                                ];
                                $color = $colors[$short] ?? 'bg-gray-100 text-gray-500';
                                @endphp
                                <span class="inline-block text-xs font-semibold font-mono px-2 py-0.5 rounded {{ $color }}">
                                    {{ $short }}
                                </span>
                                @endforeach
                            </div>
                        </td>

                        {{-- Time --}}
                        <td class="px-5 py-4">
                            <div class="inline-flex items-center gap-1.5 bg-gray-50 border border-gray-100 rounded-lg px-2.5 py-1.5">
                                <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" d="M12 6v6l4 2" />
                                </svg>
                                <span class="text-xs font-mono text-gray-600">
                                    {{ date('g:i A', strtotime($scheduleItem->start_time)) }}
                                </span>
                                <span class="text-xs text-gray-300">→</span>
                                <span class="text-xs font-mono text-gray-600">
                                    {{ date('g:i A', strtotime($scheduleItem->end_time)) }}
                                </span>
                            </div>
                        </td>

                        {{-- Action --}}
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('training_schedule_items.show', $scheduleItem->uuid) }}"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-700 border border-green-100 bg-green-50 hover:bg-green-100 hover:border-green-300 px-3 py-1.5 rounded-lg transition-colors duration-150">
                                View
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-400">No schedule items found</p>
                            <p class="text-xs text-gray-300 mt-1">Add a schedule to get started</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($scheduleItems->hasPages())
    <div class="mt-4">
        {{ $scheduleItems->links() }}
    </div>
    @endif
</div>