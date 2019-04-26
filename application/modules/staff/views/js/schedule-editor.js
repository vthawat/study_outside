$(document).ready(function(){
 /*$("#schedule-html").froalaEditor({

   // toolbarButtons: ['undo', 'redo' , 'bold', '|', 'alert', 'clear', 'insert'],
  // toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],
   fontFamilySelection: true,
   fontSizeSelection: true,
   paragraphFormatSelection: true
 });
*/

 $(function() {
  $('#schedule-html')
    .froalaEditor({
      fontFamilySelection: true,
      fontSizeSelection: true,
      paragraphFormatSelection: true,
     // htmlAllowedTags: ['.*'],
      htmlRemoveTags: ['script'],
      // Set the save param.
      saveParam: 'schedule_html',

      // Set the save URL.
      saveURL: "<?=base_url('staff/put/schedule/'.$trips->id)?>",

      // HTTP request type.
      saveMethod: 'POST',

      // Additional save params.
     // saveParams: {id: 'my_editor'}
    })
    .on('froalaEditor.save.before', function (e, editor) {
      // Before save request is made.
    })
    .on('froalaEditor.save.after', function (e, editor, response) {
      // After successfully save request.
      //alert(response);
    })
    .on('froalaEditor.save.error', function (e, editor, error) {
      // Do something here.
      alert('ไม่สามารถบันทึกได้')
    })
});


 /**  Save Schedule */
 $('.save-schedule').click(function(){

  $('#schedule-html').froalaEditor('save.save');
  /* var schedule_html;
   schedule_html=$('#schedule-html').val();
    //console.log(schedule_html)
    $.ajax({ method: "POST",
    url: "<?=base_url('staff/put/schedule/'.$trips->id)?>",
    data:{schedule_html:schedule_html}
                  })
                    .fail(function(){
                        alert('ไม่สามารถบันทึกได้')
                    })
                    .done(function( msg ) {
                      var trip_id="<?=$trips->id?>";
                      var url="<?=base_url('staff/trip/custom_schedule/')?>";
                      url+=trip_id;
                      alert(msg);
                     // window.location.href=url;
                          });
  
*/
 });
})