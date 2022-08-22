<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class Discounts extends Component
{
    use WithPagination;

    public $count = 10;

    protected $listeners = ['remove'];

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function alertConfirm($id){

        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $id,
            'type' => 'warning',
            'message' => 'آیا کد تخفیف حذف شود؟',
            'text' => ''
        ]);
    }
    public function remove($id)
    {
        \App\Models\Discount::find($id)->delete();

        $this->emit('success-alert');
    }


    public function render()
    {
        $discounts = auth()->user()->discounts()->latest()->paginate($this->count);
        return view('livewire.site.profile.discounts' ,['discounts' => $discounts])->layout('layouts.profile');
    }
}
