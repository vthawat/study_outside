$(document).ready(function(){

  $('#record-html2pdf').summernote({

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

  $('.save-record-html2pdf').click(function(){
    

    $.ajax({ method: "POST",
    url: "<?=base_url('staff/cars/put_record_html2pdf/'.$car_record->id)?>",
    data:{"record_html2pdf":$('#record-html2pdf').summernote('code')}
                  })
                    .fail(function(){
                        alert('ไม่สามารถบันทึกได้')
                    })
                    .done(function( msg ) {
                        console.log(msg);
                          });
  })
})