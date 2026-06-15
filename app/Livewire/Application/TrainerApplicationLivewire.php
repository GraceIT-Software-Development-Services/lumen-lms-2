<?php

namespace App\Livewire\Application;

use App\Models\User;
use Livewire\Component;

class TrainerApplicationLivewire extends Component
{
    public function render()
    {
        $applicants = User::role('Trainer')
            ->where('is_confirmed', false)
            ->select('users.*')
            ->selectSub(function ($query) {
                $query->selectRaw('GROUP_CONCAT(a.name ORDER BY a.name SEPARATOR ", ")')
                    ->from('learner_associations as la')
                    ->join('associations as a', 'a.id', '=', 'la.association_id')
                    ->whereColumn('la.user_id', 'users.id');
            }, 'association_names')
            ->paginate(30);

        return view('livewire.application.trainer-application-livewire', [
            'applicants' => $applicants,
        ]);
    }
}
