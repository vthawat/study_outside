<?php $place_selected=json_decode($trips->place_ordering);?>
<div class="col-md-4">
<h4><i class="fa fa-fw fa-list"></i>ลำดับสถานที่ใหม่ เพื่อปรับเปลี่ยนเส้นทาง</h4>
<ul class="list-group place-sortable">
<?php $i=1;foreach($place_selected as $item):?>
<?php if($item->place_id!=0):?>
<li class="list-group-item pid-<?=$item->place_id?>">
  <input type="hidden" class="splace-id" value="<?=$item->place_id?>">
<h3 class="text-blue thai-webfont"><span class="place-order-number"><?=$i?></span> <?=$item->place_name?></h3>
  <?php $place_details=$this->study_place->get_by_id($item->place_id);?>
  <?php $location_point=$place_details->lat.':'.$place_details->long.':'.$place_details->id.':'.$place_details->place_name.':'.$place_details->map_address;?>
  <input type="hidden" class="splace-location-point" value="<?=$location_point?>">
  <address>ต.<?=$place_details->DISTRICT_NAME?>อ.<?=$place_details->AMPHUR_NAME?>จ.<?=$place_details->PROVINCE_NAME?></address>
</li>
<?php $i++;endif;?>
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