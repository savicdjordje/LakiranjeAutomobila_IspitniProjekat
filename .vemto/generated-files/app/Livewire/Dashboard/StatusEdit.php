<?php

namespace App\Livewire\Dashboard;

use App\Models\Status;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Livewire\Dashboard\Statuses\Forms\UpdateForm;

class StatusEdit extends Component
{
    public ?Status $status = null;

    public UpdateForm $form;

    public function mount(Status $status)
    {
        $this->authorize('view-any', Status::class);

        $this->status = $status;

        $this->form->setStatus($status);
    }

    public function save()
    {
        $this->authorize('update', $this->status);

        $this->validate();

        $this->form->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dashboard.statuses.edit', []);
    }
}
