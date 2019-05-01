$(document).ready(function(){
 /*$("#schedule-html").froalaEditor({

   // toolbarButtons: ['undo', 'redo' , 'bold', '|', 'alert', 'clear', 'insert'],
  // toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],
   fontFamilySelection: true,
   fontSizeSelection: true,
   paragraphFormatSelection: true
 });
*/

$('#schedule-html').summernote({

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

  //$('#schedule-html').froalaEditor('save.save');
   var schedule_html=$('#schedule-html').summernote('code');;
    //console.log(schedule_html)
    $.ajax({ method: "POST",
    url: "<?=base_url('staff/put/schedule/'.$trips->id)?>",
    data:{schedule_html:schedule_html}
                  })
                    .fail(function(){
                        alert('ไม่สามารถบันทึกได้')
                    })
                    .done(function( msg ) {

                     // window.location.href=url;
                          });
  
 });
})