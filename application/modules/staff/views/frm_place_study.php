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
</form>