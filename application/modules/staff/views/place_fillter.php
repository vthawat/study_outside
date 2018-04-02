<form method="post" class="form-horizontal country-fillter" action="<?=base_url('trader/profile/fillter')?>">
	<div class="form-group">
		 <label for="geo" class="col-sm-3 control-label">ภูมิภาค</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="geo" name="geo_id">
		 		<option value="">--เลือกภูมิภาค--</option>
		 		<?php foreach($geo_fillter as $item):?>
		 			<?php if($this->input->get_post('geo_id')==$item->GEO_ID):?>
		 			<option value="<?=$item->GEO_ID?>" selected><?=$item->GEO_NAME?></option>
		 			<?php else:?>
		 			<option value="<?=$item->GEO_ID?>"><?=$item->GEO_NAME?></option>
		 		<?php endif?>	
		 		<?php endforeach;?>
		 	</select>
		 </div>
	</div>
	<div class="form-group">
		 <label for="province" class="col-sm-3 control-label">จังหวัด</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="province" name="province_id">
		 		<option value="">--เลือกจังหวัด--</option>
		 		<?php if(empty($this->input->get_post('geo_id'))):?>
		 		<?php else:?>
		 			<?php $province_list=$this->country_province->get_by_geo_id($this->input->get_post('geo_id'));?>
		 			<?php foreach($province_list as $item):?>
		 				<?php if($this->input->get_post('province_id')==$item->PROVINCE_ID):?>
		 					<option value="<?=$item->PROVINCE_ID?>" selected><?=$item->PROVINCE_NAME?></option>
		 				<?php else:?>
		 				<option value="<?=$item->PROVINCE_ID?>"><?=$item->PROVINCE_NAME?></option>
		 				<?php endif?>
		 			<?php endforeach;?>
		 		<?php endif;?>
		 	</select>
		 </div>
	</div>
	<div class="form-group">
		 <label for="amphur" class="col-sm-3 control-label">อำเภอ</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="amphur" name="amphur_id">
		 		<option value="">--เลือกอำเภอ--</option>
		 		<?php if(empty($this->input->get_post('amphur_id'))):?>
		 		<?php else:?>
		 			<?php $amphur_list=$this->country_amphur->get_by_province_id($this->input->get_post('province_id'));?>
		 			<?php foreach($amphur_list as $item):?>
		 				<?php if($this->input->get_post('amphur_id')==$item->AMPHUR_ID):?>
		 					<option value="<?=$item->AMPHUR_ID?>" selected><?=$item->AMPHUR_NAME?></option>
		 				<?php else:?>
		 				<option value="<?=$item->AMPHUR_ID?>"><?=$item->AMPHUR_NAME?></option>
		 				<?php endif?>
		 			<?php endforeach;?>
		 		<?php endif;?>
		 	</select>
		 </div>
	</div>
		<div class="form-group">
		 <label for="published" class="col-sm-3 control-label">สถานะ</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="published" name="published">
		 		<option value="">--เลือกสถานะ--</option>
		 			<?php foreach($status_list as $item):?>
		 				<?php if($this->input->get_post('published')==$item->status):?>
		 					<option value="<?=$item->status?>" selected><?=$item->status_name?></option>
		 				<?php else:?>
		 				<option value="<?=$item->status?>"><?=$item->status_name?></option>
		 				<?php endif?>
		 			<?php endforeach;?>
		 	</select>
		 </div>
	</div>
	  	<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <button class="btn icon-btn btn-success save" type="submit"><span class="btn-glyphicon fa fa-check img-circle text-success"></span>ตกลง</button>
    </div>
  </div>

						
</form>