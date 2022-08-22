<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Edit extends Component
{
    public $type = 'account';

    public $username;
    public $avatar;
    public $email;
    public $phone;
    public $name;
    public $family;
    public $display_name_type;
    public $gender;
    public $website;
    public $phone_verified_at;

    protected $queryString = ['type'];

    public function mount()
    {
        $this->getUser();
    }

    public function getUser()
    {
        $user = auth()->user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->name = $user->name;
        $this->family = $user->family;
        $this->phone_verified_at = $user->phone_verified_at;
        $this->display_name_type = $user->display_name_type;
        $this->gender = $user->gender;
        $this->website = $user->website;
        $this->avatar = $user->avatar;
    }

    public function update()
    {
        $data = $this->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string',
            'family' => 'required|string',
            'display_name_type' => 'required',
            'gender' => 'required',
            'website' => 'nullable',
        ]);

        auth()->user()->update($data);

        $this->emit('success-alert');
    }


    public function render()
    {
        return view('livewire.site.profile.edit')->layout('layouts.profile');
    }
}
