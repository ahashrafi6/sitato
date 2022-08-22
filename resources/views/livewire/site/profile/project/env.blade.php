<div class="dir-rtl">
    <div>
        <div class="my-5 bg-gray-200 text-center p-3 rounded-lg text-sm">قبل از هرگونه تغییر در مقادیر زیر، حتما آموزش نحوه استفاده از این بخش را مشاهده نمایید. هرگونه تغییر اشتباه باعث اختلال در برنامه میشود <a href="#" class="text-blue-500" target="_blank">(آموزش متغییر‌ها)</a></div>

        <form method="POST" wire:submit.prevent="Update">
            @csrf

            <textarea wire:model.defer="envs_string" class="w-full rounded-lg text-left leading-loose dir-ltr" rows="15"></textarea>

            <div class="my-5 bg-gray-200 text-center p-3 rounded-lg text-sm">در هر بار ذخیره تغییرات ممکن است بین ۱ تا ۵ دقیقه زمان لازم باشد تا تغییرات در برنامه اعمال شود</div>

            <div class="flex justify-end mt-5">
                <span wire:loading wire:target="Update" class="text-xs text-primary-500">منتظر باشید...</span>
                <button wire:loading.remove wire:target="Update" type="submit" class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </form>

    </div>
</div>