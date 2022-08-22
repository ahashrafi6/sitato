<x-auth-layout>
    <x-auth.auth-card>


        <div class="mb-4 text-sm text-gray-600">
            جهت ادامه کار لازم است تا پسورد خود را جهت تایید وارد نمایید
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-auth.label for="password" value="پسورد" />

                <x-auth.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-auth.auth-validation-error name="password"/>
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                  تایید
                </x-button>
            </div>
        </form>
    </x-auth.auth-card>
</x-auth-layout>
