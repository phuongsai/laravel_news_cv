@push('js')
<!-- Select Plugin Js -->
<script defer src="{{ asset('assets/backend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<!-- tinyMCE -->
<script src="{{ asset('assets/backend/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>

<!-- baseURL -->
<script type="text/javascript">
    // global var
    var form = $('#formData');
    function loadPreview(input){
        readURL(input);
    }
</script>

<script>
    var editor_config = {
      path_absolute : "/",
      selector: "#editor",
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

<!-- JQuery preview image -->
<script defer src="{{ asset('assets/backend/js/previewImg.js') }}"></script>
<!-- JQuery check changed -->
<script defer src="{{ asset('assets/backend/js/checkChange.js') }}"></script>

@endpush