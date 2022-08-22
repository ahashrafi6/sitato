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
        },

    });
</script>
