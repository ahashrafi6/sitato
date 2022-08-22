<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Cards extends Component
{
    protected $listeners = ['remove'];


    public function alertConfirm($id)
    {

        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $id,
            'type' => 'warning',
            'message' => 'آیا کارت بانکی حذف شود؟',
            'text' => ''
        ]);
    }

    public function remove($id)
    {
        $card = \App\Models\Card::find($id);
        if ($card &&  auth()->user()->id == $card->user_id){
            $card->delete();
        }
        $this->emit('success-alert');
    }


    public function render()
    {
        $cards = auth()->user()->cards()->get();
        return view('livewire.site.profile.cards', ['cards' => $cards])->layout('layouts.profile');
    }
}
