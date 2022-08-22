<?php

namespace App\Http\Livewire\Site\Auth;

use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $family;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $password_confirmation;

    /**
     * @return array
     */
    protected function rules(){
        return [
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required',Password::defaults(), 'confirmed'],
        ];
    }

    /**
     * @param $field
     */
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('auth.register')->layout('layouts.auth');
    }
}
