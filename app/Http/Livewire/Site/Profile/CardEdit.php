<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Card;
use Livewire\Component;

class CardEdit extends Component
{
    public Card $card;
    public $title;
    public $bank_name;
    public $card_name;
    public $card_serial;
    public $card_number;
    public $card_sheba;
    public $card_meli;

    public function mount()
    {
        if (auth()->user()->id != $this->card->user_id){
            abort(404);
        }
        $this->title = $this->card->title;
        $this->bank_name = $this->card->bank_name;
        $this->card_name = $this->card->card_name;
        $this->card_serial = $this->card->card_serial;
        $this->card_number = $this->card->card_number;
        $this->card_sheba = $this->card->card_sheba;
        $this->card_meli = $this->card->card_meli;
    }

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

        $this->card->update($data);

        session()->flash('success', 'حساب با موفقیت ویرایش شد');
        return redirect()->route('profile.cards');
    }

    public function render()
    {
        return view('livewire.site.profile.card-edit')->layout('layouts.profile');
    }
}
