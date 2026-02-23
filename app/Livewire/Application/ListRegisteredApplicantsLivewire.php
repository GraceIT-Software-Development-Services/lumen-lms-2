<?php

namespace App\Livewire\Application;

use App\Models\User;
use Livewire\Component;

class ListRegisteredApplicantsLivewire extends Component
{
    public $search = '';
    public $pageCount = 15;

    public function render()
    {
        $applicants = User::role('Student')
            ->leftJoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->orWhere('users.full_name_searchable', 'like', '%' . $this->search . '%');
                });
            })
            ->distinct()
            ->select('users.*')
            ->paginate($this->pageCount);

        return view('livewire.application.list-registered-applicants-livewire', compact('applicants'));
    }
}
