<div class="col-md-4">
<h4><i class="fa fa-fw fa-map-pin"></i>เลือกสถานที่แนะนำ</h4>
<!-- Single button action list -->
<div class="btn-group pull-right">
							  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="<?=base_url('staff/trip/edit/'.$trips->id)?>" class="text-yellow"><span class="fa fa-edit fa-fw"></span>แก้ไข</a></li>
							    <li><a href="<?=base_url('staff/trip/remove/'.$trips->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการ กำหนดการเดินทางที่เกี่ยวข้องจะถูกลบ?')"><span class="fa fa-remove fa-fw"></span>ลบ</a></li>
							  </ul>
</div>
<p>องค์ความรู้ที่สนใจ: <?php foreach(json_decode($trips->knowledge_selected,TRUE) as $knowledge):?><span class="label label-primary"><?=$knowledge?></span> <?php endforeach?></p>
<p>สาขาวิชา: <?php if($trips->subject_major_selected!='null') foreach(json_decode($trips->subject_major_selected,TRUE) as $subject_major_id):?><span class="label label-success"><?=$this->ftps->get_subject_major($subject_major_id)->major_name?></span> <?php endforeach?></p>

<ul class="list-group">
<?php if(empty($place_relation)):?><div class="alert alert-info"><h3 class="thai-font"><i class="fa fa-fw fa-exclamation-circle"></i>ไม่พบข้อมูลสถานที่ ที่สัมพันธ์กับ</h3>
<p>องค์ความรู้ที่สนใจ: <?php foreach(json_decode($trips->knowledge_selected,TRUE) as $knowledge):?><span class="label label-primary"><?=$knowledge?></span> <?php endforeach?></p>
<p>สาขาวิชา: <?php if($trips->subject_major_selected!='null') foreach(json_decode($trips->subject_major_selected,TRUE) as $subject_major_id):?><span class="label label-success"><?=$this->ftps->get_subject_major($subject_major_id)->major_name?></span> <?php endforeach?></p>
</div><?php endif?>
<?php foreach($place_relation as $item):?>
  <?php if($item->lat!='0'&&$item->long!='0'):?>
<li class="list-group-item">
<h3 class="text-success thai-webfont"><i class="fa fa-fw fa-map-pin"></i><?=$item->place_name?></h3>
<div class="col-xs-6">
  <?php  $knowledge_items=$this->study_place->get_knowledge_by_study_place_id($item->id);?>
  <?php if(!empty($knowledge_items)):?>   
          <div class="well">
                <img class="img-responsive" src="<?=base_url('images/knowledge/'.$knowledge_items[0]->images)?>">
            </div>

  <?php else:?>
          <div class="well">
                  <img class="img-responsive" src="<?=base_url('images/knowledge/none-images.png')?>">
          </div>
  <?php endif?>
  </div>
  <address>ต.<?=$item->DISTRICT_NAME?></address>
  <address>อ.<?=$item->AMPHUR_NAME?></address>
  <address>จ.<?=$item->PROVINCE_NAME?></address>
  <div class="btn-group">
							  <a class="btn btn-primary" data-toggle="modal" href="<?=base_url('staff/place_detail/'.$item->id)?>" data-target=".modal"><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="fa fa-cog fa-fw"></span><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
                  <li><a href="<?=base_url('staff/place/knowledge/'.$item->id)?>" class="text-blue"><i class="fa fa-fw fa-info-circle"></i>องค์ความรู้ของสถานที่</a></li>
                  <li><a href="<?=base_url('staff/place/edit/'.$item->id)?>" class="text-yellow"><i class="fa fa-fw fa-pencil"></i>แก้ไข</a></li>
                  <li><a href="<?=base_url('staff/delete/place/'.$item->id)?>" class="text-red" onclick="return confirm('ยืนยันการลบรายการสถานที่: <?=$item->place_name?>?')"><i class="fa fa-fw fa-remove"></i>ลบ</a></li>
							  </ul>
							</div>
                        <div class="material-switch pull-right">
                            <?php $location_point=$item->lat.':'.$item->long.':'.$item->id.':'.$item->place_name.':'.$item->map_address;?>
                            <?php $array_place=array();if(!empty($trips->place_selected))
                                 {
                                $place_selected=json_decode($trips->place_selected,TRUE);
                                foreach($place_selected as $place) array_push($array_place,$place['place_id']);
                                 } 
                                if(in_array($item->id,$array_place)):
                            ?>
                            <input id="place-id-<?=$item->id?>" value="<?=$location_point?>" class="place-selected" name="map_place_id[]" type="checkbox" checked/>
                            <?php else:?>
                            <input id="place-id-<?=$item->id?>" value="<?=$location_point?>" class="place-selected" name="map_place_id[]" type="checkbox"/>
                            <?php endif;?>
                            <label for="place-id-<?=$item->id?>" class="label-danger"></label>
                        </div>
  <div class="clearfix"></div>
</li>
<?php endif?>
<?php endforeach?>
</ul>
</div>
<div class="col-md-8"><h4><i class="fa fa-fw fa-map"></i>เส้นทาง<i class="fa fa-fw fa-angle-double-right"></i><?=$trips->start_location?> - <?=$trips->end_location?></h4>
<div id="map-waypoint" class="well"></div>
<h4><i class="fa fa-fw fa-clock-o"></i>รายละเอียดของเส้นทางการเดินทาง สถานที่ ระยะทางและเวลา</h4>
<div id="directions-panel"></div>
<?php if($this->study_trip->check_trip_status($trips->status)==2):?>
  <a class="btn icon-btn btn-success" href="<?=base_url('staff/trip/schedule/'.$trips->id)?>"><span class="btn-glyphicon fa fa-table img-circle text-green"></span>สร้างตารางกำหนดการเดินทาง</a>
<?php endif?>
</div>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->