<div class="dir-rtl">
    <p class="dark:text-white mb-5">نحوه اتصال</p>
    <div class="bg-white dark:bg-gray-700 dark:text-white p-5 rounded-lg flex flex-col mb-10">
        <div class="p-3 flex items-center gap-3">
            <span class="text-gray-500">نام دیتابیس: </span>
            <span class="dark:text-white">{{ $database['dbName'] }}</span>
        </div>
        <div class="p-3 flex items-center gap-3">
            <span class="text-gray-500">نام کاربری: </span>
            <span class="dark:text-white">{{ $database['username'] }}</span>
        </div>
        <div class="p-3 flex items-center gap-3">
            <span class="text-gray-500">رمزعبور: </span>
            <span class="dark:text-white">{{ $database['root_password'] }}</span>
        </div>
    </div>
    <div class="flex items-center flex-col lg:flex-row gap-5">
       <div>
        <p class="dark:text-white mb-2">راه اندازی  ‌PHPMyAdmin</p>
        <p class="text-gray-500 text-sm">بعد از ۵ ساعت فعال‌بودن، به صورت خودکار حذف می‌گردد.</p>
       </div>
       @if (isset($database['metaData']['controlPanelCreatedAt'] ) && $database['metaData']['controlPanelCreatedAt'] != null)
      <div>
        <a href="https://{{ $database['metaData']['controlPanelID'] }}.iran.liara.run" target="_blank" class="btn btn-blue text-sm cursor-pointer" wire:click="phpmyadmin">بازکردن phpmyadmin</a>
        <p class="text-orange-500 text-xs mt-4">راه اندازی تا ۱ دقیقه زمانبر است (اطلاعات ورود به PHPMyAdmin، همان نام کاربری و رمز عبور دیتابیس‌تان است)</p>
      </div>
       @else
       <span class="btn btn-blue text-sm cursor-pointer" wire:click="phpmyadmin">راه اندازی</span>
       @endif
       
    </div>

</div>