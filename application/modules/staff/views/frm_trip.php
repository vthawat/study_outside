<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="subject_list" class="col-sm-2 control-label">เลือกรายวิชา</label>
    <div class="col-sm-10">
      <select name="subject_list_id" id="subject_list" class="form-control">
        <option value="">--เลือกรายวิชา--</option>
        <?php if(!empty($Subject_list)) foreach($Subject_list as $item):?>
        <option value="<?=$item->id?>"><?=$item->subject_code?> <?=$item->subject_name?></option>
        <?php endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="trip-start" class="col-sm-2 control-label">วันที่เริ่มเดินทาง</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="start_date" id="trip-start"  value="" required>
    </div>
    <label for="trip-start" class="col-sm-2 control-label">ถึงวันที่</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="end_date" id="trip-end"  value="" required>
    </div>
  </div>
  <div class="form-group">
    <label for="trip-duration" class="col-sm-2 control-label">จำนวนวัน</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="duration" id="trip-duration"  value="" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="select-trip-mode" class="col-sm-2 control-label"></label>
    <div class="col-sm-3">
      <input type="radio" name="trip_mode" id="trip-mode-1" value="1"> <label for="trip-mode-1">ค้างคืน/ต้องการที่พัก</label>
    </div>
    <div class="col-sm-3">
      <input type="radio" name="trip_mode" id="trip-mode-2" value="2"> <label for="trip-mode-2">ไม่พักค้างคืน/ไป-กลับ</label>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">เลือกสาขาวิชา</label>
    <div class="col-sm-5">
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
</form>