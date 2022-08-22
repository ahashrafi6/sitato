<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class CardCreate extends Component
{
    public $title;
    public $bank_name;
    public $card_name;
    public $card_serial;
    public $card_number;
    public $card_sheba;
    public $card_meli;


    public function hydrate()
    {
        $this->emit('select2');
    }

    public function send()
    {
        $data = $this->validate([
            'title' => 'required|string',
            'card_name' => 'required|string',
            'card_meli' => 'required|digits:10',
            'bank_name' => 'required|string',
            'card_serial' => 'required',
            'card_number' => 'required|digits:16',
            'card_sheba' => 'required|digits:24',
        ]);

        auth()->user()->cards()->create($data);

        session()->flash('success', 'حساب با موفقیت ثبت شد');
        return redirect()->route('profile.cards');
    }

    public function render()
    {
        return view('livewire.site.profile.card-create')->layout('layouts.profile');
    }
}
