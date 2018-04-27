<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
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
    <label for="address" class="col-sm-2 control-label">ที่อยู่*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="address" id="address"  value="<?php if(!empty($edit_item)) print $edit_item->address?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="province" class="col-sm-2 control-label">จังหวัด*</label>
    <div class="col-sm-10">
      <select name="province_id" id="province" class="form-control">
        <option value="0">--เลือก--</option>
        <?php foreach($Province as $item):?>
        <option value="<?=$item->PROVINCE_ID?>"><?=$item->PROVINCE_NAME?></option>
        <?php endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="amphur" class="col-sm-2 control-label">อำเภอ*</label>
    <div class="col-sm-10">
      <select name="amphur_id" id="amphur" class="form-control">
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="district" class="col-sm-2 control-label">ตำบล*</label>
    <div class="col-sm-10">
      <select name="district_id" id="district" class="form-control">
      </select>
    </div>
  </div>
  <div class="box-body">
  <h4 class="text-success">พิกัดของสถานที่ศึกษาดูงานภาคสนาม</h4>
		<div class="form-group">
		  <div>
			  <input <?php if(!empty($trader)):?>value="<?=$trader->map_address?>"<?php endif?> id="map-address" name="map_address" type="text" class="form-control">
			  <span class="help-block">ค้นหาสถานที่ ระบุชื่อสถานที่</span> 
			 </div>
		 </div>		
		<div class="input-group">
      		<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i>Latitude</span>
			<input <?php if(!empty($project_planning->LATITUDE)):?>value="<?=$project_planning->LATITUDE?>"<?php endif?> class="form-control" type="text" name="latitude" id="latitude" />
			<span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i>Longtitude</span>
			<input <?php if(!empty($project_planning->LONGTITUDE)):?>value="<?=$project_planning->LONGTITUDE?>"<?php endif?> class="form-control" type="text" name="longtitude"  id="longtitude" />
		</div>
<div id="gm-map"></div>
</div>
</form>