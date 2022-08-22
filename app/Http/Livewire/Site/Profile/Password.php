<?php

namespace App\Http\Livewire\Site\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Password extends Component
{
    public $password;
    public $password_confirmation;

    protected function rules(){
        return [
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults(), 'confirmed'],
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function changePassword()
    {
        $this->validate();

        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->password = '';
        $this->password_confirmation = '';

        $this->emit('success-alert');
    }

    public function render()
    {
        return <<<'blade'
        <div>
            <form method="POST" wire:submit.prevent="changePassword">
                    @csrf

                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 lg:col-span-6">
                            <x-auth.label for="password" value="پسورد جدید"/>

                            <x-auth.input wire:model.lazy="password" id="password" class="block mt-1 w-full"
                                          type="password"
                                          required/>

                            <x-auth.auth-validation-error name="password"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <x-auth.label for="password_confirmation" value="تکرار پسورد جدید"/>

                            <x-auth.input wire:model.lazy="password_confirmation" id="password_confirmation"
                                          class="block mt-1 w-full"
                                          type="password"
                                          required/>
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button class="btn btn-primary" type="submit">تغییر پسورد</button>
                    </div>

                </form>
        </div>
        blade;
    }
}
