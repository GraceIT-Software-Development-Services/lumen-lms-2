<?php

namespace App\Livewire\Association;

use App\Models\Association;
use Livewire\Component;
use Livewire\WithPagination;

class AssociationLivewire extends Component
{
    use WithPagination;

    private int $pageCount = 15;

    public bool $showModal = false;
    public ?string $editingUuid = null;

    public string $search = '';

    // Form fields
    public string $name = '';
    public string $type = 'Association';
    public string $address = '';
    public string $description = '';

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:Cooperative,Association,Company',
            'address'     => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function toggleModal(): void
    {
        $this->resetForm();
        $this->editingUuid = null;
        $this->showModal = true;
    }

    public function editAssociation(string $uuid): void
    {
        $association = Association::where('uuid', $uuid)->firstOrFail();

        $this->editingUuid = $uuid;
        $this->name = $association->name;
        $this->type = $association->type ?? 'Association';
        $this->address = $association->address ?? '';
        $this->description = $association->description ?? '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name'        => $this->name,
            'type'        => $this->type,
            'address'     => $this->address ?: null,
            'description' => $this->description ?: null,
        ];

        if ($this->editingUuid) {
            Association::where('uuid', $this->editingUuid)->update($data);
        } else {
            Association::create($data);
        }

        $this->closeModal();
        $this->resetPage();

        session()->flash(
            'success',
            $this->editingUuid ? 'Association updated successfully.' : 'Association saved successfully.'
        );
    }

    public function deleteAssociation(string $uuid): void
    {
        Association::where('uuid', $uuid)->delete();

        $this->resetPage();

        session()->flash('success', 'Association deleted successfully.');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'name',
            'address',
            'description',
            'editingUuid',
        ]);

        $this->type = 'Association';

        $this->resetErrorBag();
    }

    public function render()
    {
        $associations = Association::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('type', 'like', '%' . $this->search . '%')
                        ->orWhere('address', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->pageCount);

        return view('livewire.association.association-livewire', [
            'associations' => $associations,
        ]);
    }
}
