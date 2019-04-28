<style>
.nav>li>a{
 height: 45px;

}
</style>
<div>
    <div class="pull-right" style="margin-right:200px;">
                			<!-- Single button -->
                      <div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                                <li><a href="<?=base_url('staff/trip/student/'.$trips->id)?>"><span class="fa fa-fw fa-user"></span>รายชื่อผู้ร่วมเดินทาง</li>
                                <li role="separator" class="divider"></li>
                                <?php if($this->study_trip->check_trip_status($trips->status)==1):?>
                                <li><a href="<?=base_url('staff/trip/waypoint/'.$trips->id)?>" class="text-green"><span class="fa fa-fw fa-map-marker"></span>สร้างเส้นทาง</a></li>
							    <?php elseif($this->study_trip->check_trip_status($trips->status)<=3):?>
<?php if($this->study_trip->has_schedule($trips->id)):?><li><a href="<?=base_url('staff/trip/custom_schedule/'.$trips->id)?>" class="text-black"><span class="fa fa-fw fa-table"></span>ปรับแต่งกำหนดการเดินทางด้วยตนเอง</a></li><?php endif;?>
                                <li><a href="<?=base_url('staff/trip/schedule/'.$trips->id)?>" class="text-green"><span class="fa fa-fw fa-table"></span>สร้างกำหนดการเดินทางอัตโนมัติ</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?=base_url('staff/trip/custom_route/'.$trips->id)?>" class="text-blue"><span class="fa fa-fw fa-map"></span>ปรับเปลี่ยนเส้นทางด้วยตนเอง</a></li>
                                <li><a href="<?=base_url('staff/trip/waypoint/'.$trips->id)?>" class="text-aqua"><span class="fa fa-fw fa-map-o"></span>สร้างเส้นทางอัตโนมัติ</a></li>
                                <?php endif?>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?=base_url('staff/trip/edit/'.$trips->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/delete/trip/'.$trips->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
							</div>
    </div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs trip-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab"><i class="fa fa-fw fa-table"></i>กำหนดการเดินทาง</a></li>
    <li role="presentation"><a href="#weather" aria-controls="weather" role="tab" data-toggle="tab"><i class="fa fa-fw fa-cloud"></i>พยากรณ์อากาศ</a></li>
    <li role="presentation"><a href="#students" aria-controls="students" role="tab" data-toggle="tab"><i class="fa fa-fw fa-user"></i>รายชื่อผู้ร่วมเดินทาง</a></li>

  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="schedule">
        <?php if(!empty($schedule->schedule_html)):?>
            <?=$schedule->schedule_html;?>
        <?php else:?>
            <div class="alert alert-warning"><h4>ไม่พบข้อมูล กำหนดการเดินทาง เนื่องจากยังไม่สร้างกำหนดการเดินทาง</h4></div>
        <?php endif?>
    </div>
    <div role="tabpanel" class="tab-pane" id="weather"><?=$force_casts?></div>
    <div role="tabpanel" class="tab-pane" id="students"><?=$student_list?></div>

  </div>

</div>
<div class="box-footer text-center">
<button class="btn icon-btn btn-default" data-dismiss="modal"><span class="btn-glyphicon fa fa-stop img-circle text-gray"></span>Close</button>
</div>
