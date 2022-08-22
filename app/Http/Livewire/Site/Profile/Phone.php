<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\VerifyCode;
use App\Notifications\VerifyPhone;
use Livewire\Component;

class Phone extends Component
{
    public $status = 'code';
    public $phone;
    public $code;

    public function mount()
    {
        if (auth()->user()->phone_verified_at){
            $this->status = 'verified';
        }
    }

    private function validate_phone()
    {
        $data = $this->validate([
            'phone' => 'required|phone:IR,mobile|unique:users,phone,' . auth()->user()->id . ',id'
        ]);

        return phone($data['phone'], 'IR')->formatForMobileDialingInCountry('IR');
    }

    public function sendCode()
    {
        $phone = $this->validate_phone();

        $user = auth()->user();

        $user->update([
            'phone' => $phone
        ]);

        $user->notify(new VerifyPhone());

        $this->phone = $phone;
        $this->status = 'verify';
        $this->emit('verify-code-send');
    }

    public function verifyCode()
    {
        $data = $this->validate([
            'code' => 'required|integer|digits:4|exists:verify_codes,code'
        ]);


        $code = [
            'code' => $data['code'],
            'phone' => $this->phone
        ];
        $verifyCode = VerifyCode::where($code)->exists();
        if ($verifyCode){
            auth()->user()->update([
                'phone_verified_at' => now(),
            ]);
            $this->status = 'verified';
        }else{
            $this->emit('verify-code-wrong');
        }
    }

    public function resendCode()
    {
        auth()->user()->notify(new VerifyPhone());
        $this->emit('verify-code-send');
    }


    public function render()
    {
        return <<<'blade'
        <div x-data="{ tab: @entangle('status') }">

            <div wire:loading class="w-full lg:w-6/12 mx-auto">
                <p class="text-center dark:text-white">صبور باشید...</p>
            </div>

           <div wire:loading.remove>
                 <div x-show.transition="tab === 'code'">
                <form method="POST" wire:submit.prevent="sendCode">
                    @csrf

                        <div class="w-full lg:w-6/12 mx-auto">

                            <x-auth.label for="username" value="شماره موبایل"/>

                            <x-auth.input wire:model.defer="phone" id="phone" class="block mt-1 w-full"
                                          type="text"
                                          required/>

                            <x-auth.auth-validation-error name="phone"/>
                            <div class="flex justify-end mt-8">
                                <button class="btn btn-primary" type="submit">ارسال کد تایید</button>
                            </div>
                        </div>

                </form>
            </div>
            <div x-show.transition="tab === 'verify'">


                <form method="POST" wire:submit.prevent="verifyCode">
                    @csrf

                        <div class="w-full lg:w-6/12 mx-auto">
                         <div class="flex items-center dir-rtl bg-yellow-100 p-4 rounded-md border-2 border-yellow-300 mb-5">
                            <p class="text-yellow-600 text-xs">کد تایید برایتان ارسال شد، به علت ترافیک مخابراتی لطفا حداکثر تا 5 دقیقه صبور باشد و درصورت عدم دریافت کد از دکمه ارسال مجدد استفاده کنید</p>
                        </div>

                            <x-auth.label for="code" value="کد تایید"/>

                            <x-auth.input wire:model.defer="code" id="code" class="block mt-1 w-full"
                                          type="text"
                                          required/>

                            <x-auth.auth-validation-error name="code"/>
                            <div class="flex justify-between items-center mt-8">
                                <span wire:click="resendCode" class="cursor-pointer text-sm text-gray-500 dark:text-white">ارسال مجدد کد</span>
                                <button class="btn btn-primary" type="submit">تایید کد</button>
                            </div>
                        </div>

                </form>
            </div>

            <div x-show.transition="tab === 'verified'">
                    <div class="flex items-center dir-rtl bg-green-100 p-4 rounded-md border-2 border-green-300">
                        <p class="text-success-500 text-sm">شماره موبایل شما تایید شده است و امکان تغییر آن وجود ندارد، در صورت نیاز اساسی دلیل خود را به صورت تیکت به واحد ارتباط با اشتراک وردپرس ارسال نمایید.</p>
                    </div>
                    <div class="mt-3">
                        <span class="text-gray-500">شماره موبایل فعلی: </span>
                        <span class="font-bold dark:text-white">{{ auth()->user()->phone }}</span>
                    </div>
            </div>
           </div>

        </div>
        blade;
    }
}
