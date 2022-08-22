<x-auth.auth-card>

        <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Address -->
            <div>
                <x-auth.label for="email" value="ایمیل"/>

                <x-auth.input wire:model.lazy="email" id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email', $email)" required autofocus/>
                <x-auth.auth-validation-error name="email"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-auth.label for="password" value="پسورد جدید"/>

                <x-auth.input wire:model.lazy="password" id="password" class="block mt-1 w-full" type="password" name="password" required/>
                <x-auth.auth-validation-error name="password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-auth.label for="password_confirmation" value="تکرار پسورد جدید"/>

                <x-auth.input wire:model.lazy="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="block mt-4 float-right" wire:ignore>
                <div class="g-recaptcha" data-sitekey="6LdnpPQaAAAAAEHwvTffi0d2LiGjA2xoNP-NYdN0"></div>
            </div>

            <div class="w-full flex items-center dir-rtl float-right mt-2 mb-4">
                @error('g-recaptcha-response')
                <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                <p class="text-red-500 text-xs">لطفا از فعال بودن گزینه امنیتی
                    شناسایی ربات مطمئن شوید</p>
                @enderror
            </div>

            <div class="w-full mt-4 float-right">
                <x-button>
                    بروزرسانی پسورد
                </x-button>
            </div>
        </form>
    </x-auth.auth-card>

