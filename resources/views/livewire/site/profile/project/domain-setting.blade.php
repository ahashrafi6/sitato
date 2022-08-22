<x-site.info-modal :name="4">
    <x-slot name="button">

        <div class="flex flex-col gap-4">
            <a href="#" class="btn btn-primary">تنظیمات</a>
        </div>

    </x-slot>

    <x-slot name="title">{{ $domain['name'] }}</x-slot>


    <p class="text-lg mb-3">ریدایرکت دامنه</p>
    <p class="text-sm text-gray-500 mb-3">اگر می‌خواهید برنامه‌ی‌تان با چندین دامنه و یا زیردامنه (مانند www) در دسترس باشد، با این قابلیت می‌توانید دامنه‌ها و زیردامنه‌ها را به یک دامنه‌ی مشخص ریدایرکت کنید. توجه داشته باشید دامنه‌ای را که قصد دارید به آن ریدایرکت کنید، قبلا باید در بخش «دامنه‌ها»، اضافه کرده باشید.</p>

    <div class="grid grid-cols-12 gap-3 plans-holder">
        <div class="col-span-6 flex flex-col">
            <span class="text-sm mb-2">انتخاب دامنه</span>
            <select wire:model="redirect_to" class="rounded-md">
                <option value="" {{ $domain['redirectTo'] == '' ? 'selected' : '' }}>بدون ریدایرکت</option>
                @foreach ($domains as $item)
                @if ($domain['name'] != $item['name'])
                       <option value="{{  'http://' . $item['name']  }}">{{ $item['name'] }}</option>   
                @endif

                @endforeach
            </select>
        </div>
        <div class="col-span-6 flex flex-col">
            <span class="text-sm mb-2">نوع ریدایرکت</span>
            <select wire:model="redirect_status" class="rounded-md">
                <option value="301">ریدایرکت دائمی</option>
                <option value="302">ریدایرکت موقت</option>
            </select>
        </div>
    </div>
    <div class="flex justify-end mt-5">
        <span wire:click="updateRedirect" class="btn btn-blue cursor-pointer text-sm">ذخیره</span>
    </div>

    <p class="text-lg mt-6 mb-3">گواهی SSL</p>
  
    @if ($ssl == 'ACTIVE')
    <p class="text-sm text-primary-500 mb-3 flex items-center gap-2">
        <i class="fal fal-lock text-xl"></i>
        گواهی SSL این دامنه فعال است
    </p>
    <span wire:click="updateSSL('DEACTIVE')" class="btn btn-gray mt-4 cursor-pointer"><i class="fal fa-unlock"></i> غیرفعالسازی ‌SSL</span>
    @else
    <p class="text-sm text-gray-500 mb-3">با تهیه‌ی گواهی SSL رایگان فقط یک قدم فاصله دارید. با تهیه‌ی این گواهی، ارتباط کاربران شما با برنامه‌ی‌تان در بستر HTTPS صورت می‌گیرد که باعث افزایش امنیت آن خواهد شد.</p>
    <span wire:click="updateSSL('ACTIVE')" class="btn btn-blue mt-4 cursor-pointer"><i class="fal fa-lock"></i> تهیه گواهی ‌SSL</span>
    @endif
  


</x-site.info-modal>