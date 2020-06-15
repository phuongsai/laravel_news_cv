@push('js')
<!-- Select Plugin Js -->
<script defer src="{{ asset('assets/backend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<!-- CKEditor -->
{{-- <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
{{-- <script defer src="{{ asset('assets/backend/plugins/ckeditor/ckeditor.js') }}"></script> --}}
{{-- <script defer src="{{ asset('assets/backend/js/ckeditor.js') }}"></script> --}}
<script src="{{ asset('assets/backend/plugins/tinymce/js/tinymce/tinymce.min.js')}}"></script>
{{-- <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script> --}}

<!-- baseURL for CKEditor -->
<script type="text/javascript">
        // global var
    // var urlCK = "{{route('upload.image', ['_token' => csrf_token() ])}}";
    var form = $('#formData');
    function loadPreview(input){
        readURL(input);
    }
</script>


{{-- <script>
    var editor_config = {
      selector: "#content",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;

            //restricted it to image only using resource_type = image in url, you can set it to auto for all types

            xhr.open('POST', 'https://api.cloudinary.com/v1_1/phuonghoang/image/upload');

            xhr.onload = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var url = response.secure_url; //get the url
                    var json = {location: url}; //set it in the format tinyMCE wants it
                    success(json.location);
                }
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('upload_preset', 'a4ea63ua');

            xhr.send(formData);
        }

    };

    tinymce.init(editor_config);
</script> --}}


<script>
    var editor_config = {
      path_absolute : "/",
      selector: "#content",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_picker_callback: function (callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        let type = 'image' === meta.filetype ? 'Images' : 'Files',
            url  = editor_config.path_absolute + 'filemanager?editor=tinymce5&type=' + type;

        tinymce.activeEditor.windowManager.openUrl({
            url : url,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
    };

    tinymce.init(editor_config);
</script>

{{-- <script>
    var editor_config = {
      path_absolute : "/",
      selector: "#content",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinymce.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
</script> --}}


<script>
    var options = {
      filebrowserImageBrowseUrl: '/filemanager?type=Images',
      filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/filemanager?type=Files',
      filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('content', options);
</script>
<!-- JQuery preview image -->
<script defer src="{{ asset('assets/backend/js/previewImg.js') }}"></script>
<!-- JQuery check changed -->
<script defer src="{{ asset('assets/backend/js/checkChange.js') }}"></script>

@endpush