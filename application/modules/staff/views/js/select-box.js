$(function () {
	
	$('#amphur').change(function(){
		var get_url="<?=base_url($this->router->fetch_class())?>/json_get_district_by_amphur_id/"+$(this).val();
		$('#district').empty();
		$.getJSON(get_url, function( data )
		 {

			//alert(data[0].district_name);
			 $.each( data, function( key, item ) {

   			 $('#district').append('<option value="'+item.id+'">'+item.district_name+'</option>');

  			});
		

		});
	});

	$('#district').change(function(){
		var get_url="<?=base_url($this->router->fetch_class())?>/json_get_village_by_district_id/"+$(this).val();
		$('#village').empty();
		$.getJSON(get_url, function( data )
		 {

			//alert(data[0].district_name);
			 $.each( data, function( key, item ) {

   			 $('#village').append('<option value="'+item.id+'">'+item.village_name+'</option>');

  			});
		

		});
	});


	$('.fugitive-person').change(function(){
		$num_person=$(this).val();

		 $name_list='<div class="col-sm-offset-2 col-sm-10"><div class="col-sm-2">';
 			$name_list+='<select name="FUGITIVE_PRENAME[]" class="form-control">';
 				$name_list+='<option value="1">นาย</option>';
 				$name_list+='<option value="2">นาง</option>';
 				$name_list+='<option value="3">นางสาว</option>';
 				$name_list+='<option value="4">เด็กชาย</option>';
 				$name_list+='<option value="5">เด็กหญิง</option>';
 			$name_list+='</select>';
 		$name_list+='</div>';
 		$name_list+='<div class="col-sm-3"><input type="text" name="FUGITIVE_FIRST_NAME[]" class="form-control" placeholder="ชื่อ"></div>';
 		$name_list+='<div class="col-sm-3"><input type="text" name="FUGITIVE_LAST_NAME[]" class="form-control" placeholder="นามสกุล"></div>';
 		$name_list+='<div class="col-sm-2">';
 			$name_list+='<select name="FUGITIVE_STATUS[]" class="form-control">';
 				$name_list+='<option value="0">-สถานะ-</option>';
 				$name_list+='<option value="1">ป.วิอาญา</option>';
 				$name_list+='<option value="2">พรก.</option>';
 				$name_list+='<option value="3">ระแวง</option>';
 			$name_list+='</select>';
 		$name_list+='</div></div>';
 		$('.fugitive-name').html('');
 		
 		for (i = 1; i <= $num_person; i++) {

			$('.fugitive-name').append($name_list);
 		}
 		//$('.fugitive-name').append($name_list);
 		//alert($name_list);
	});

	$('.patient-person').change(function(){
		$num_person=$(this).val();
		 	$name_list='<div class="col-sm-offset-2 col-sm-10"><div class="col-sm-2">';
		 			$name_list+='<select name="PATIENT_PRENAME[]" class="form-control">';
		 				$name_list+='<option value="1">นาย</option>';
		 				$name_list+='<option value="2">นาง</option>';
		 				$name_list+='<option value="3">นางสาว</option>';
		 				$name_list+='<option value="4">เด็กชาย</option>';
		 				$name_list+='<option value="5">เด็กหญิง</option>';
		 			$name_list+='</select>';
		 		$name_list+='</div>'
		 		$name_list+='<div class="col-sm-2"><input type="text" name="PATIENT_FIRST_NAME[]" class="form-control" placeholder="ชื่อ"></div>';
		 		$name_list+='<div class="col-sm-3"><input type="text" name="PATIENT_LAST_NAME[]" class="form-control" placeholder="นามสกุล"></div>';
		 		$name_list+='</div>';
		 	$('.patient-name').html('');
		 	for (i = 1; i <= $num_person; i++) {
				 $('.patient-name').append($name_list);
				}
	});


	$('.num-family-member').click(function(){

			$(this).val(parseInt($('.num-male').val())+parseInt($('.num-female').val()));

	});

});
