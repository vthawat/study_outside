<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="subject_list" class="col-sm-2 control-label">เลือกรายวิชา</label>
    <div class="col-sm-4">
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
        <div class="input-daterange input-group" id="datepicker">
            <input type="text" class="form-control start_date" name="start_date" />
            <span class="input-group-addon">ถึง</span>
            <input type="text" class="form-control end_date" name="end_date" />
        </div>
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
    <div class="col-sm-2">
      <input type="radio" name="trip_mode" id="trip-mode-1" value="1"> <label for="trip-mode-1">ค้างคืน/ต้องการที่พัก</label>
    </div>
    <div class="col-sm-2">
      <input type="radio" name="trip_mode" id="trip-mode-2" value="2"> <label for="trip-mode-2">ไม่พักค้างคืน/ไป-กลับ</label>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สถานที่เริ่มต้น</label>
    <div class="col-sm-5"><input type="text" name="start_location" class="form-control" value=" คณะทรัพยากรธรรมชาติ มหาวิทยาลัยสงขลานครินทร์ ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา">
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สถานที่ปลายทาง</label>
    <div class="col-sm-3">
      <select class="form-control" name="end_location">
          <option value="">--เลือกจังหวัด--</option>
          <?php foreach($EndLocationList as $item):?>
          <option value="<?=$item->PROVINCE_NAME?>"><?=$item->PROVINCE_NAME?></option>
          <?php endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สาขาวิชา</label>
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
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">องค์ความรู้ที่สนใจ</label>
    <div class="col-md-10 col-sm-10">
    <ul class="list-unstyled">
    <?php $know_id=0;foreach($Knowledge_item as $item):?>
					<li style="font-size:14px;" class="col-md-3 col-xs-6"><input type="checkbox" name="knowledge_id[]" id="knowledge-<?=$know_id?>" value="<?=$item->title?>"> <label for="knowledge-<?=$know_id?>"><?=$item->title?></label></li>
				<?php $know_id++;endforeach?>
    </li>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-3"><button class="btn btn-success"><i class="fa fa-fw fa-search"></i>ค้นหาสถานที่</button></div>
  </div>
</form>