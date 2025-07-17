<?php

namespace App\Livewire\Dashboard\Bills\Forms;

use Livewire\Form;
use App\Models\Bill;
use Illuminate\Validation\Rule;

class UpdateForm extends Form
{
    public ?Bill $bill;

    public $service_id = '';

    public $price = '';

    public function rules(): array
    {
        return [
            'service_id' => ['required'],
            'price' => ['required'],
        ];
    }

    public function setBill(Bill $bill)
    {
        $this->bill = $bill;

        $this->service_id = $bill->service_id;
        $this->price = $bill->price;
    }

    public function save()
    {
        $this->validate();

        $this->bill->update($this->except(['bill', 'service_id']));
    }
}
