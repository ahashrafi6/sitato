<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ارسال تیکت</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">ثبت تیکت مدیریت</p>
        </div>
    </div>

    <form method="POST" wire:submit.prevent="save">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div wire:ignore class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="کاربر (نام یک کاربر را تایپ کنید)"/>
                <select class="select2-data-ajax-users form-control" id="search-users"></select>
                @error('user_id')
                <div class="flex items-center dir-rtl mt-1">
                    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                    <p class="text-red-500 text-xs">فیلد کاربر الزامی است</p>
                </div>
                @enderror
            </div>

            <div class="col-span-12 mb-3 lg:mb-0">
                <x-auth.label for="username" class="mb-1" value="عنوان تیکت"/>

                <x-auth.input wire:model.defer="title" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="title"/>
            </div>

            <div class="col-span-12 mb-3 lg:mb-0">
                <x-auth.label for="body" class="mb-1" value="متن تیکت"/>

                <textarea rows="6" wire:model.defer="body"
                          class="w-full rounded-md focus:ring-0 border-gray-200 transition text-sm leading-loose text-gray-500"
                          placeholder="توضیح ..."></textarea>
                <x-auth.auth-validation-error name="body"/>
            </div>
        </div>


        <div class="ticket-files flex items-center my-5 gap-4">
            <span id="select-files" class="btn btn-gray cursor-pointer">+ پیوست فایل</span>

            @foreach($files as $key => $file)
                <div class="bg-gray-200 rounded-md py-2 px-3 relative">
                    <i wire:click="removeFile({{ $key }})"
                       class="fal fa-times cursor-pointer absolute text-xs -top-2 -left-2 text-white bg-red-400 rounded-full py-0.5 px-1"></i>
                    <a href="{{ img_url($file['url']) }}" target="_blank" class="text-xs">{{ $file['name'] }}</a>
                </div>
            @endforeach
        </div>


        <div class="flex justify-end">
            <span wire:loading wire:target="save" class="text-xs text-primary-500">در حال ثبت، منتظر باشید...</span>
            <button wire:loading.remove wire:target="save" type="submit" class="btn btn-primary">ثبت تیکت</button>
        </div>
    </form>

</div>

<x-slot name="script">
    <script src="{{ asset('assets/site/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>

    <script>
        //select2

        window.initSelectStationDrop = () => {
            //ajax data select2 users
            $(".select2-data-ajax-users").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
                ajax: {
                    url: "/dashboard/users-search",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.items,
                        };
                    },
                },
                placeholder: 'نام یک کاربر را جستجو کنید',
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 1,
                templateResult: formatRepo_title,
                templateSelection: formatRepoSelection_title
            });

            function formatRepo_title(repo) {
                if (repo.loading) return repo.text;

                var markup = "<div class='select2-result-repository clearfix'>" + (repo.author_name != null ? repo.author_name : (repo.username != null ? repo.username : repo.email)) + "</div>";

                return markup;
            }

            function formatRepoSelection_title(repo) {
                return (repo.author_name != null ? repo.author_name : (repo.username != null ? repo.username : repo.email));
            }
        }
        initSelectStationDrop();
        window.livewire.on('select2', () => {
            initSelectStationDrop();
        });

        $('#search-users').on('change', function (e) {
            var data = $('#search-users').select2("val");
            @this.set('user_id', data);
        });

    </script>
</x-slot>


