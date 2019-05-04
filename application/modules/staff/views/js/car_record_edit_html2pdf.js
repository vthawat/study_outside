$(document).ready(function(){
  $('.save-record-html2pdf').click(function(){
    

    $.ajax({ method: "POST",
    url: "<?=base_url('staff/put_car_record_html2pdf/'.$car_record->id)?>",
    data:{"record_html2pdf":$('#record-html2pdf').val()}
                  })
                    .fail(function(){
                        alert('ไม่สามารถบันทึกได้')
                    })
                    .done(function( msg ) {
                        console.log(msg);
                          });
  })
})