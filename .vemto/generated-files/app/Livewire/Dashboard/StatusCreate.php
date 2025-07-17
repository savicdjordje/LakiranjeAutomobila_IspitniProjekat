<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Statuses\Forms\CreateForm;

class StatusCreate extends Component
{
    use WithFileUploads;

    public CreateForm $form;

    public function mount()
    {
    }

    public function save()
    {
        $this->authorize('create', Status::class);

        $this->validate();

        $status = $this->form->save();

        return redirect()->route('dashboard.statuses.edit', $status);
    }

    public function render()
    {
        return view('livewire.dashboard.statuses.create', []);
    }
}
