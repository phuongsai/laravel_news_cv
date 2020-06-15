(function ( $ ) {
    $.fn.extend($.fn,{
        trackChanges: function() {
          $(':input:not([type=submit]), textarea, textarea#ckeditor',this).on('propertychange change paste keyup select input', (function() {
          // $(this).find(':input:not([type=submit]), textarea, textarea#tinymce').on('propertychange change paste keyup select input', (function() {
            $(this.form).data('changed', true);
          }));
        }
        ,
        isChanged: function() { 
          return this.data('changed'); 
        }
       });
}( jQuery ));

$(document).ready(function(){
    
  form.trackChanges();

  form.submit(function(e){
      window.onbeforeunload = null;
      if (!form.isChanged())
      {
          e.preventDefault();
          alert ('Nothing changed!!!');
          return false;
      }
  })

  window.onbeforeunload = function(){
      if (form.isChanged())
      {
          return 'Are you sure you want to leave?'
      }
  }
 
});
