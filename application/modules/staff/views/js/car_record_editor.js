$(document).ready(function(){
 /*$("#schedule-html").froalaEditor({

   // toolbarButtons: ['undo', 'redo' , 'bold', '|', 'alert', 'clear', 'insert'],
  // toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],
   fontFamilySelection: true,
   fontSizeSelection: true,
   paragraphFormatSelection: true
 });
*/

$('#record-html').summernote({

  toolbar: [
      // [groupName, [list of button]]
      //['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize','fontname']],
      ['style', ['bold', 'italic', 'underline','strikethrough', 'superscript', 'subscript', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height','table']],
      ['misc',['undo','redo','fullscreen']]
    ]
});


 /**  Save Schedule */
 $('.save-schedule').click(function(){


  
 });
})