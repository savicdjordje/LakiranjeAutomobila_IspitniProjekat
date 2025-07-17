<?php

namespace App\Livewire\Dashboard\Bills\Forms;

use Livewire\Form;
use App\Models\Bill;
use Livewire\Attributes\Rule;

class UpdateDetailForm extends Form
{
    public ?Bill $bill;

    public $price = '';

    public function rules(): array
    {
        return [
            'price' => ['required'],
        ];
    }

    public function setBill(Bill $bill)
    {
        $this->bill = $bill;

        $this->price = $bill->price;
    }

    public function save()
    {
        $this->validate();

        $this->bill->update($this->except(['bill']));
    }
}
