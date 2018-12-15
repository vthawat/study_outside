<form method="post" class="form-horizontal country-fillter" action="<?=base_url('staff/place_rest')?>">

	<div class="form-group">
		 <label for="province" class="col-sm-3 control-label">จังหวัด</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="province" name="province_id">
		 		<option value="">--เลือกจังหวัด--</option>
                 <?php foreach($provice_list as $item):?>
                 <option value="<?=$item->PROVINCE_ID?>" <?php if($this->input->post('province_id')==$item->PROVINCE_ID):?>selected<?php endif;?>><?=$item->PROVINCE_NAME?></option>
                 <?php endforeach;?>
		 	</select>
		 </div>
	</div>
	<div class="form-group">
		 <label for="amphur" class="col-sm-3 control-label">อำเภอ</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="amphur" name="amphur_id">
		 		<option value="">--เลือกอำเภอ--</option>
				 <?php if(!empty($this->input->post('amphur_id'))) foreach($this->amphur->get_by_province_id($this->input->post('province_id')) as $amphur):?>
					<option value="<?=$amphur->AMPHUR_ID?>" <?php if($amphur->AMPHUR_ID==$this->input->post('amphur_id')):?>selected<?php endif?>><?=$amphur->AMPHUR_NAME?></option>
				 <?php endforeach;?>
		 	</select>
		 </div>
	</div>
    	<div class="form-group">
		 <label for="district" class="col-sm-3 control-label">ตำบล</label>
		 <div class="col-sm-9">
		 	<select class="form-control" id="district" name="district_id">
		 		<option value="">--เลือกตำบล--</option>
				 <?php if(!empty($this->input->post('district_id'))) foreach($this->district->get_by_amphur_id($this->input->post('amphur_id')) as $district):?>
					<option value="<?=$district->DISTRICT_ID?>" <?php if($district->DISTRICT_ID==$this->input->post('district_id')):?>selected<?php endif?>><?=$district->DISTRICT_NAME?></option>
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