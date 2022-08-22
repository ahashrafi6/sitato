<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $email = '';
    public $phone = '';
    public $username = '';
    public $type = 'all';

    public function updatingType()
    {
        $this->resetPage();
    }
    public function updatingUsername()
    {
        $this->resetPage();
    }
    public function updatingEmail()
    {
        $this->resetPage();
    }
    public function updatingPhone()
    {
        $this->resetPage();
    }

    public function verifyEmail($status , $user_id)
    {
        if ($status == 'verified'){
            User::where('id' ,$user_id)->update([
                'email_verified_at' => now()
            ]);
        }else{
            User::where('id' ,$user_id)->update([
                'email_verified_at' => null
            ]);
        }
    }

    public function verifyPhone($status , $user_id)
    {
        if ($status == 'verified'){
            User::where('id' ,$user_id)->update([
                'phone_verified_at' => now()
            ]);
        }else{
            User::where('id' ,$user_id)->update([
                'phone_verified_at' => null
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.user.index' , [
            'users' => User::filter($this->email , $this->phone , $this->username , $this->type)->paginate(10)
        ])->extends('dashboard.master');
    }
}
