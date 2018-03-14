<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
	<div class="form-group">
    <label for="subject-major" class="col-sm-2 control-label">ชื่อสาขาวิชา*</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="major_name" id="subject-major"  value="<?php if(!empty($edit_item)) print $edit_item->major_name?>" required>
    </div>
  </div>
  	<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
  </div>
</form>