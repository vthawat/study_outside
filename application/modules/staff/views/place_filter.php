<form method="post" class="form-horizontal country-fillter" action="<?=base_url('staff/place')?>">

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
			 <div class="col-sm-12">
					<h3 class="thai-font"><i class="fa fa-fw fa-search"></i>สาขาวิชา</h3>
				<ul class="list-group">
				<?php
					if(!empty($this->input->post('subject_major_id')))
					 $array_major_item=$this->input->post('subject_major_id');
					else $array_major_item=array();
				?>
				<?php foreach($Subject_major as $key=>$item):?>
					<?php if(in_array($item->id,$array_major_item)):?>
					<li style="font-size:14px;" class="list-group-item list-group-item-success"><input type="checkbox" name="subject_major_id[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>" checked> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
					<?php else:?>
					<li style="font-size:14px;" class="list-group-item"><input type="checkbox" name="subject_major_id[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>"> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
					<?php endif?>
				<?php endforeach?>
				</ul>	
		 </div>
	</div>
	<div class="form-group">
			 <div class="col-sm-12">
				<h3 class="thai-font"><i class="fa fa-fw fa-lightbulb-o"></i>องค์ความรู้</h3>
				<ul class="list-group">
				<?php
					if(!empty($this->input->post('knowledge_id')))
					 $array_knowledge_item=$this->input->post('knowledge_id');
					else $array_knowledge_item=array();
				?>
				<?php $know_id=0;foreach($Knowledge_item as $item):?>
					<?php if(in_array($item->title,$array_knowledge_item)):?>
					<li style="font-size:14px;" class="list-group-item list-group-item-success"><input type="checkbox" name="knowledge_id[]" id="knowledge-<?=$know_id?>" value="<?=$item->title?>" checked> <label for="knowledge-<?=$know_id?>"><?=$item->title?></label></li>
					<?php else:?>
					<li style="font-size:14px;" class="list-group-item"><input type="checkbox" name="knowledge_id[]" id="knowledge-<?=$know_id?>" value="<?=$item->title?>"> <label for="knowledge-<?=$know_id?>"><?=$item->title?></label></li>
					<?php endif?>
				<?php $know_id++;endforeach?>
				</ul>			
		 </div>
	</div>
	  	<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <button class="btn icon-btn btn-success save" type="submit"><span class="btn-glyphicon fa fa-check img-circle text-success"></span>ตกลง</button>
    </div>
  </div>

						
</form>