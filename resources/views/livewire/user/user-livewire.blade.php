<div class="space-y-6">

    {{-- TOAST NOTIFICATION --}}
    <div
        x-data="{
            show: false,
            type: 'success',
            message: '',
            init() {
                $wire.on('notify', ({ type, message }) => {
                    this.type = type;
                    this.message = message;
                    this.show = true;
                    setTimeout(() => this.show = false, 3500);
                });
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-[-12px]"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-[-12px]"
        class="fixed top-5 right-5 z-[9999] flex items-center gap-3 rounded-2xl px-5 py-3.5 shadow-xl shadow-black/10 border text-sm font-medium"
        :class="{
            'bg-emerald-50 border-emerald-200 text-emerald-800 dark:bg-emerald-900/40 dark:border-emerald-700 dark:text-emerald-300': type === 'success',
            'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/40 dark:border-red-700 dark:text-red-300': type === 'error'
        }"
        style="display: none;">
        <svg x-show="type === 'success'" class="h-4 w-4 text-emerald-500 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <svg x-show="type === 'error'" class="h-4 w-4 text-red-500 dark:text-red-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <span x-text="message"></span>
        <button @click="show = false" class="ml-2 opacity-50 hover:opacity-100">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    @if ($showDeleteModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-gray-900/60 dark:bg-black/70" wire:click="cancelDelete"></div>

        {{-- Modal Panel --}}
        <div class="relative z-10 w-full max-w-md rounded-2xl bg-white dark:bg-gray-800 shadow-xl border border-gray-200 dark:border-gray-700">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/40">
                        <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Delete User</h3>
                </div>
                <button wire:click="cancelDelete" class="rounded-lg p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-gray-300 transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 py-5">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Are you sure you want to delete the user
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $confirmingDeleteName }}</span>?
                    This action <span class="font-medium text-red-600 dark:text-red-400">cannot be undone</span>.
                </p>
            </div>

            {{-- Modal Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 dark:border-gray-700 px-6 py-4">
                <button
                    wire:click="cancelDelete"
                    class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    Cancel
                </button>
                <button
                    wire:click="deleteUser"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700 disabled:opacity-60 dark:bg-red-700 dark:hover:bg-red-600">
                    <span wire:loading.remove wire:target="deleteUser">Delete User</span>
                    <span wire:loading wire:target="deleteUser" class="flex items-center gap-2">
                        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        Deleting…
                    </span>
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-lg shadow-indigo-200 dark:shadow-indigo-900/40">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Users</h1>
                <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">Manage and monitor all system users</p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            {{-- Search --}}
            <div class="relative">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search user..."
                    class="w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:w-72 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-900/40">
            </div>

            {{-- Create --}}
            <a
                href="{{ route('users-create.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:shadow-indigo-900/40 dark:focus:ring-offset-gray-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New User
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">User Directory</h2>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">View user details, email, assigned roles, and manage records.</p>
                </div>
                @if(method_exists($users, 'total'))
                <div class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 border border-indigo-100 dark:bg-indigo-900/30 dark:border-indigo-800 dark:text-indigo-400">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500 dark:bg-indigo-400"></span>
                    {{ $users->total() }} user{{ $users->total() !== 1 ? 's' : '' }}
                </div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50/80 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 w-14">#</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">User</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Email</th>
                        <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Roles</th>
                        <th class="px-6 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 w-32">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                    @forelse ($users as $user)
                    <tr class="group transition-colors hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10">
                        <td class="px-6 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-bold text-gray-500 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors dark:bg-gray-700 dark:text-gray-400 dark:group-hover:bg-indigo-900/40 dark:group-hover:text-indigo-400">
                                {{ $loop->iteration }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-400 to-violet-500 text-sm font-bold text-white shadow-sm shadow-indigo-200 dark:shadow-indigo-900/40">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                                    <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">ID #{{ $user->id }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1.5">
                                @forelse ($user->roles as $role)
                                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:border-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                    {{ $role->name }}
                                </span>
                                @empty
                                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-0.5 text-xs font-medium text-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                    No role
                                </span>
                                @endforelse
                            </div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                {{-- Edit / You badge --}}
                                @if($user->id !== auth()->id())
                                <a
                                    href="{{ route('users-edit.edit', $user->id) }}"
                                    title="Edit user"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 hover:border-indigo-300 hover:shadow-sm dark:border-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400 dark:hover:bg-indigo-900/50 dark:hover:border-indigo-700">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                    </svg>
                                    Edit
                                </a>
                                @else
                                <span class="inline-flex items-center rounded-xl px-3 py-1.5 text-xs text-gray-300 dark:text-gray-600 select-none" title="You cannot edit your own account here">
                                    You
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 dark:bg-gray-700 text-gray-300 dark:text-gray-600">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">No users found</h3>
                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Try adjusting your search or create a new user.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($users->hasPages())
    <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        {{ $users->links() }}
    </div>
    @endif

</div>