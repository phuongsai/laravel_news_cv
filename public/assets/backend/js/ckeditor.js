$(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor',{
         filebrowserUploadUrl: urlCK,
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.config.height = 300;
    });