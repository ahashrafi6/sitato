<div class="dir-rtl">


    @foreach ($disks as $item)
    <div class="bg-white dark:bg-gray-700 dark:text-white p-5 rounded-lg flex flex-col mb-5">
        <div class="p-3 flex items-center gap-3">
            <span class="text-gray-500">نام دیسک: </span>
            <span class="dark:text-white">{{  $item['disk']['name'] }}</span>
        </div>
        <div class="p-3 flex items-center gap-3">
            <span class="text-gray-500">سایز دیسک: </span>
            <span class="dark:text-white">{{  $item['disk']['size'] }} GB</span>
        </div>
        <div class="flex items-center flex-wrap gap-5">
            <span>دسترسی ftp: </span>
            @if ($item['ftp'] == null)
                <span wire:click="createFtp('{{ $item['disk']['name'] }}')" class="btn btn-blue text-sm cursor-pointer">ایجاد دسترسی FTP</span>
            @else
               <div class="bg-gray-100 p-1 rounded-md flex items-center flex-wrap gap-3 text-sm">
                <span>هاست: {{ $item['host'] }}</span>
                <span>پورت: 2112</span>
                <span>نام کاربری: {{ $item['ftp']['username'] }}</span>
                <span>رمزعبور: {{ $item['ftp']['password'] }}</span>
               </div>
            @endif
        </div>
    </div>
    @endforeach
   

</div>