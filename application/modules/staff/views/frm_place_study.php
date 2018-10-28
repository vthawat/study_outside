<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
 <div class="col-md-8">
 <div class="form-group">
    <label for="place-name" class="col-sm-2 control-label">ชื่อสถานที่*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="place_name" id="place-name"  value="<?php if(!empty($edit_item)) print $edit_item->place_name?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="contact-name" class="col-sm-2 control-label">ชื่อ-นามสกุล ผู้ติดต่อ*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="contact_name" id="contact-name"  value="<?php if(!empty($edit_item)) print $edit_item->contact_name?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="contact-position" class="col-sm-2 control-label">ตำแหน่ง ผู้ติดต่อ*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="contact_position" id="contact-position"  value="<?php if(!empty($edit_item)) print $edit_item->contact_position?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="contact-phone" class="col-sm-2 control-label">หมายเลขโทรศัพท์*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="contact_phone" id="contact-phone"  value="<?php if(!empty($edit_item)) print $edit_item->contact_phone?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="contact-fax" class="col-sm-2 control-label">หมายเลขโทรสาร</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="contact_fax" id="contact-fax"  value="<?php if(!empty($edit_item)) print $edit_item->contact_fax?>">
    </div>
  </div>
  <div class="form-group">
    <label for="contact-email" class="col-sm-2 control-label">อีเมล</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="contact_email" id="contact-email"  value="<?php if(!empty($edit_item)) print $edit_item->contact_email?>">
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="col-sm-2 control-label">ที่อยู่*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="address" id="address"  value="<?php if(!empty($edit_item)) print $edit_item->address?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="province" class="col-sm-2 control-label">จังหวัด*</label>
    <div class="col-sm-10">
      <select name="province_id" id="province" class="form-control" required>
        <option value="0">--เลือก--</option>
        <?php foreach($Province as $item):?>
        <option value="<?=$item->PROVINCE_ID?>" <?php if(!empty($edit_item)) if($item->PROVINCE_ID==$edit_item->province_id):?>selected<?php endif?>><?=$item->PROVINCE_NAME?></option>
        <?php endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="amphur" class="col-sm-2 control-label">อำเภอ*</label>
    <div class="col-sm-10">
      <select name="amphur_id" id="amphur" class="form-control" required>
        <?php if(!empty($edit_item)):?>
            <?php $amphur_list=$this->amphur->get_by_province_id($edit_item->province_id)?>
            <?php foreach($amphur_list as $item):?>
                <option value="<?=$item->AMPHUR_ID?>" <?php if(!empty($edit_item)) if($item->AMPHUR_ID==$edit_item->amphur_id):?>selected<?php endif?>><?=$item->AMPHUR_NAME?></option>
            <?php endforeach?>
        <?php endif?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="district" class="col-sm-2 control-label">ตำบล*</label>
    <div class="col-sm-10">
      <select name="district_id" id="district" class="form-control" required>
      <?php if(!empty($edit_item)):?>
            <?php $district_list=$this->district->get_by_amphur_id($edit_item->amphur_id)?>
            <?php foreach($district_list as $item):?>
                <option value="<?=$item->DISTRICT_ID?>" <?php if(!empty($edit_item)) if($item->DISTRICT_ID==$edit_item->district_id):?>selected<?php endif?>><?=$item->DISTRICT_NAME?></option>
            <?php endforeach?>
        <?php endif?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="place-spec" class="col-sm-2 control-label">การประเมินสถานที่</label>
    <div class="col-sm-10">
      <textarea name="place_spec" id="place-spec" rows="6" class="form-control"><?php if(!empty($edit_item)) print $edit_item->place_spec?></textarea>
    </div>
  </div>
 </div>
 <div class="col-md-4">
      <div class="alert bg-warning">
      <label>สาขาวิชา</label>
      <ul class="list-group">
      <?php foreach($Subject_major as $item):?>
        <?php if(!empty($edit_item)&&$this->study_place->get_study_place_major_list($edit_item->id,$item->id)):?>
        <li style="font-size:14px;" class="list-group-item list-group-item-success"><input type="checkbox" name="subject_major_id[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>" checked> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
        <?php else:?>
        <li style="font-size:14px;" class="list-group-item"><input type="checkbox" name="subject_major_id[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>"> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
        <?php endif?>
      <?php endforeach?>
      </ul>
      </div>
 </div>

 <div class="clearfix"></div>
 
 <div class="box-body">
  <h4 class="text-success">พิกัดของสถานที่ศึกษาดูงานภาคสนาม</h4>
		<div class="form-group">
		  <div>
			  <input <?php if(!empty($edit_item)):?>value="<?=$edit_item->map_address?>"<?php endif?> id="map-search" name="map_address" type="text" class="form-control">
			  <span class="help-block">ค้นหาสถานที่ ระบุชื่อสถานที่</span> 
			 </div>
		 </div>		
		<div class="input-group">
      		<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i>Latitude</span>
			<input <?php if(!empty($edit_item->lat)):?>value="<?=$edit_item->lat?>"<?php endif?> class="form-control" type="text" name="lat" id="latitude" />
			<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i>Longtitude</span>
			<input <?php if(!empty($edit_item->long)):?>value="<?=$edit_item->long?>"<?php endif?> class="form-control" type="text" name="long"  id="longtitude" />
		</div>
<div id="gm-map"></div>
</div>
<div class="text-center">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-mail-reply img-circle text-primary"></span>ยกเลิก</a>
</div>


</form>