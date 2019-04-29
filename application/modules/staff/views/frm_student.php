<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="std-code" class="col-sm-2 control-label">รหัสนักศึกษา*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="std_code" id="std-code"  value="<?php if(!empty($edit_item)) print $edit_item->std_code?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="first-name" class="col-sm-2 control-label">ชื่อ*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="first_name" id="first-name"  value="<?php if(!empty($edit_item)) print $edit_item->first_name?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="last-name" class="col-sm-2 control-label">นามสกุล*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="last_name" id="last-name"  value="<?php if(!empty($edit_item)) print $edit_item->last_name?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="comment" class="col-sm-2 control-label">หมายเหตุ</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="comment" id="comment"><?php if(!empty($edit_item)) print $edit_item->comment?></textarea>
    </div>
  </div>  
  	<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
  </div>
</form>