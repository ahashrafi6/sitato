@extends('site.profile.master')

@section('body')
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-12 lg:col-span-3 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">ویرایش محصول</h4>
                <a href="{{ $product->path() }}" target="_blank" class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</a>
            </div>
        </div>

        <form action="/profile/products/body-edit/{{ $product->slug }}/update" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-12 gap-3">
                <div class="col-span-12 mb-3 lg:mb-0">
                    <textarea name="body" class="sub-editor">{{ $product->body }}</textarea>
                    <x-auth.auth-validation-error name="body"/>
                </div>

                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary">
                        ذخیره
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.sub-editor',
            plugins: 'image code print preview directionality link table hr advlist lists textcolor wordcount colorpicker',
            toolbar: 'undo redo | formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link image | alignleft aligncenter alignright alignjustify ltr rtl | numlist bullist outdent indent | code |',
            menubar: 'edit format',
            directionality: 'rtl',
            min_height: 450,


            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/tiny/upload',
            file_picker_types: 'image',

            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');


                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);


                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    </script>
@endsection
