<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Institution\Models\Center;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserLivewire extends Component
{
    use WithPagination;

    public $search = null;
    public $perPage = 13;
    public $confirmingDeleteId = null;
    public $confirmingDeleteName = null;
    public $showDeleteModal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $userId): void
    {
        $user = User::findOrFail($userId);
        $this->confirmingDeleteId = $userId;
        $this->confirmingDeleteName = $user->name;
        $this->showDeleteModal = true;
    }

    public function deleteUser(): void
    {
        if ($this->confirmingDeleteId === Auth::id()) {
            $this->dispatch('notify', type: 'error', message: 'You cannot delete your own account.');
            $this->confirmingDeleteId = null;
            $this->confirmingDeleteName = null;
            return;
        }

        $user = User::find($this->confirmingDeleteId);
        if ($user) {
            $user->delete();
            $this->dispatch('notify', type: 'success', message: "User '{$this->confirmingDeleteName}' deleted successfully.");
        }

        $this->confirmingDeleteId = null;
        $this->confirmingDeleteName = null;
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
        $this->confirmingDeleteName = null;
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $query = $this->search
            ? trim($this->search)
            : null;

        if (auth()->user()->hasRole('Super Admin')) {
            $users = User::role(['Super Admin', 'Director', 'Trainer', 'Center Admin'])
                ->where('is_active', true)
                ->when($query, fn($q) => $q->where(
                    fn($q2) => $q2
                        ->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                ))
                ->paginate($this->perPage);
        } else {
            $users = User::role(['Director', 'Trainer', 'Center Admin'])
                ->where('is_active', true)
                ->when($query, fn($q) => $q->where(
                    fn($q2) => $q2
                        ->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                ))
                ->paginate($this->perPage);
        }

        $roles = Role::all();

        $centers = Center::all();

        return view('livewire.user.user-livewire', [
            'users' => $users,
            'rolelists' => $roles,
            'centers' => $centers
        ]);
    }

    public function saveUser() {}
}
