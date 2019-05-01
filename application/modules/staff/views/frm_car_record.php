<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="booking-num" class="col-sm-2 control-label">มอ 520/</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_num" id="booking-num"  value="<?php if(!empty($edit_item)) print $edit_item->subject_code?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="booking-date" class="col-sm-2 control-label">วันที่</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="booking_date" id="booking-date"  value="<?=$this->ftps->DateThai(date('Y-m-d'))?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-title" class="col-sm-2 control-label">เรื่อง</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_title" id="booking-title"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-reference" class="col-sm-2 control-label">เรียน</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_reference" id="booking-reference"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-objective" class="col-sm-2 control-label">ด้วย</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="booking_objective" id="booking-objective"  value="รายวิชา <?=$this->ftps->get_subject($trips->subject_list_id)->subject_code?> <?=$this->ftps->get_subject($trips->subject_list_id)->subject_name?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-go-place" class="col-sm-2 control-label">ไปปฏิบัติงานที่</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_go_place" id="booking-go-place"  value="จังหวัด<?=trim($trips->end_location)?>" required>
    </div>
  </div>

  <div class="form-group">
    <label for="booking-research-name" class="col-sm-2 control-label">ชื่อโครงการวิจัย</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="booking_research_name" id="booking-research-name"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-depart-place" class="col-sm-2 control-label">สถานที่ให้รถมารับ</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="booking_depart_place" id="booking-depart-place"  value="<?php if(!empty($edit_item)) print $edit_item->subject_name?>">
    </div>
  </div>

  <div class="form-group">
    <label for="booking-depart-time" class="col-sm-2 control-label">เวลา</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="booking_depart_time" id="booking-depart-time"  value="<?=$trips->start_timeframe?>">
    </div>
  </div>

  	<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>สร้างบันทึกข้อความ</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
  </div>
</form>