<form method="post" class="form-horizontal" action="<?php if(!empty($action)) print $action?>">
<div class="form-group">
    <label for="subject_list" class="col-sm-2 control-label">เลือกรายวิชา</label>
    <div class="col-sm-4">
      <select name="subject_list_id" id="subject_list" class="form-control">
        <option value="">--เลือกรายวิชา--</option>
        <?php if(!empty($Subject_list)) foreach($Subject_list as $item):?>
        <?php if(!empty($edit_item)&&$edit_item->subject_list_id==$item->id):?>
        <option value="<?=$item->id?>" selected><?=$item->subject_code?><?=$item->subject_name?></option>
        <?php else:?>
        <option value="<?=$item->id?>"><?=$item->subject_code?><?=$item->subject_name?></option>
        <?php endif;endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="trip-start" class="col-sm-2 control-label">วันที่เริ่มเดินทาง</label>
    <div class="col-sm-4">
        <div class="input-daterange input-group" id="datepicker">
        <?php if(!empty($edit_item)){
            // change format date
              $start_date=explode('-',$edit_item->start_date);
              $start_date=$start_date[2].'/'.$start_date[1].'/'.$start_date[0];

              $end_date=explode('-',$edit_item->end_date);
              $end_date=$end_date[2].'/'.$end_date[1].'/'.$end_date[0];
        }?>
            <input type="text" class="form-control start_date" name="start_date" value="<?php if(!empty($edit_item)) print $start_date?>"/>
            <span class="input-group-addon">ถึง</span>
            <input type="text" class="form-control end_date" name="end_date" value="<?php if(!empty($edit_item)) print $end_date?>"/>
        </div>
    </div>
    </div>
    <div class="form-group">
    <label for="start_timeframe" class="col-sm-2 control-label">กรอบเวลา</label>
    <div class="col-sm-4">
        <div class="input-timerange input-group">
            <input type="text" class="form-control start_timeframe" name="start_timeframe" value="<?php if(!empty($edit_item)) print $edit_item->start_timeframe; else print "8.00";?>"/>
            <span class="input-group-addon">ถึง</span>
            <input type="text" class="form-control end_timeframe" name="end_timeframe" value="<?php if(!empty($edit_item)) print $edit_item->end_timeframe;else print "18.00";?>"/>
        </div>
    </div>
  </div>

  <div class="form-group">
    <label for="trip-duration" class="col-sm-2 control-label">จำนวนวัน</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="duration" id="trip-duration"  value="<?php if(!empty($edit_item)) print $edit_item->duration?>" required readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="select-trip-mode" class="col-sm-2 control-label"></label>
    <div class="col-sm-2">
      <input type="radio" name="trip_mode" id="trip-mode-1" value="1" <?php if(!empty($edit_item)&&$edit_item->trip_mode==1) print 'checked'?>> <label for="trip-mode-1">ค้างคืน/ต้องการที่พัก</label>
    </div>
    <div class="col-sm-2">
      <input type="radio" name="trip_mode" id="trip-mode-2" value="2" <?php if(!empty($edit_item)&&$edit_item->trip_mode==2) print 'checked'?>> <label for="trip-mode-2">ไม่พักค้างคืน/ไป-กลับ</label>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สถานที่เริ่มต้น</label>
    <div class="col-sm-5"><input type="text" name="start_location" class="form-control" value="คณะทรัพยากรธรรมชาติ มหาวิทยาลัยสงขลานครินทร์" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สถานที่ปลายทาง</label>
    <div class="col-sm-3">
      <select class="form-control" name="end_location">
          <option value="">--เลือกจังหวัด--</option>
          <?php foreach($EndLocationList as $item):?>
          <?php if(!empty($edit_item)&&$edit_item->end_location==$item->PROVINCE_NAME):?>
          <option value="<?=$item->PROVINCE_NAME?>" selected><?=$item->PROVINCE_NAME?></option>
          <?php else:?>
          <option value="<?=$item->PROVINCE_NAME?>"><?=$item->PROVINCE_NAME?></option>
      <?php endif;endforeach?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">สาขาวิชา</label>
    <div class="col-sm-5">
    <?php if(!empty($edit_item)) $array_subject_major=json_decode($edit_item->subject_major_selected,TRUE); ?>
     <ul class="list-group">
      <?php foreach($Subject_major as $item):?>
        <?php if(!empty($edit_item)&&in_array($item->id,$array_subject_major)):?>
        <li style="font-size:14px;" class="list-group-item list-group-item-success"><input type="checkbox" name="subject_major_selected[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>" checked> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
        <?php else:?>
        <li style="font-size:14px;" class="list-group-item"><input type="checkbox" name="subject_major_selected[]" id="subject-major-<?=$item->id?>" value="<?=$item->id?>"> <label for="subject-major-<?=$item->id?>"><?=$item->major_name?></label></li>
        <?php endif?>
      <?php endforeach?>
      </ul>
    </div>
  </div>
  <div class="form-group">
    <label for="major-list" class="col-sm-2 control-label">องค์ความรู้ที่สนใจ</label>
    <div class="col-md-10 col-sm-10">
    <?php if(!empty($edit_item)) $array_knowledge=json_decode($edit_item->knowledge_selected,TRUE); ?>
    <ul class="list-group">
    <?php $know_id=0;foreach($Knowledge_item as $item):?>
      <?php if(!empty($edit_item)&&in_array($item->title,$array_knowledge)):?>
      <li style="font-size:14px;" class="list-group-item list-group-item-info col-md-3 col-xs-6"><input type="checkbox" name="knowledge_selected[]" id="knowledge-<?=$item->id?>" value="<?=$item->title?>" checked> <label for="knowledge-<?=$item->id?>"><?=$item->title?></label></li>  
      <?php else:?>
      <li style="font-size:14px;" class="list-group-item col-md-3 col-xs-6"><input type="checkbox" name="knowledge_selected[]" id="knowledge-<?=$item->id?>" value="<?=$item->title?>"> <label for="knowledge-<?=$item->id?>"><?=$item->title?></label></li>
				<?php $know_id++;endif;endforeach?>
    </li>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-3">
    <button class="btn icon-btn btn-success save"><span class="btn-glyphicon fa fa-save img-circle text-success"></span>บันทึก</button>
    <a class="btn icon-btn btn-default cancel" href="javascript:history.back()"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>ยกเลิก</a>
    </div>
  </div>
</form>