<?php

namespace App\Http\Livewire\Site\Auth;

use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    protected $queryString = ['email'];

    /**
     * @param $token
     */
    public function mount($token)
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    protected function rules(){
        return [
            'email' => 'required|email',
            'password' => ['required',Password::defaults(), 'confirmed'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('auth.reset-password' , ['token' , $this->token])->layout('layouts.auth');
    }
}
