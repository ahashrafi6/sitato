<?php

namespace App\Http\Livewire\Site\Auth;

use Livewire\Component;

class Login extends Component
{
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;

    /**
     * @var string[]
     */
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

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
        return view('auth.login')->layout('layouts.auth');
    }
}
