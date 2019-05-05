<?php $place_selected=json_decode($trips->place_ordering);?>
<br>
<div class="col-md-4">
<p>องค์ความรู้ที่สนใจ: <?php foreach(json_decode($trips->knowledge_selected,TRUE) as $knowledge):?><span class="label label-primary"><?=$knowledge?></span> <?php endforeach?></p>
<p>สาขาวิชา: <?php if($trips->subject_major_selected!='null') foreach(json_decode($trips->subject_major_selected,TRUE) as $subject_major_id):?><span class="label label-success"><?=$this->ftps->get_subject_major($subject_major_id)->major_name?></span> <?php endforeach?></p>
<ul class="list-group place-sortable">
<?php $i=1;foreach($place_selected as $item):?>
<?php if($item->place_id!=0):?>
<li class="list-group-item pid-<?=$item->place_id?>">
  <input type="hidden" class="splace-id" value="<?=$item->place_id?>">
<h3 class="text-blue thai-webfont"><span class="place-order-number"><?=$i?>.</span> <?=$item->place_name?></h3>
<div class="col-xs-6">
  <?php  $knowledge_items=$this->study_place->get_knowledge_by_study_place_id($item->place_id);?>
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
  <?php $place_details=$this->study_place->get_by_id($item->place_id);?>
  <?php $location_point=$place_details->lat.':'.$place_details->long.':'.$place_details->id.':'.$place_details->place_name.':'.$place_details->map_address;?>
  <input type="hidden" class="splace-location-point" value="<?=$location_point?>">
  <address>ต.<?=$place_details->DISTRICT_NAME?>อ.<?=$place_details->AMPHUR_NAME?>จ.<?=$place_details->PROVINCE_NAME?></address>
  <a class="btn btn-primary" data-toggle="modal" href="<?=base_url('staff/place_detail/'.$item->place_id)?>" data-target=".modal-place-detail"><i class="fa fa-fw fa-search-plus"></i>ดูรายละเอียด</a>
  <div class="clearfix"></div>
</li>
<?php $i++;endif;?>
<?php endforeach?>
</ul>
</div>
<div class="col-md-8">
<div id="map-waypoint" class="well"></div>
<h4><i class="fa fa-fw fa-clock-o"></i>รายละเอียดของเส้นทางการเดินทาง สถานที่ ระยะทางและเวลา</h4>
<div id="directions-panel"></div>
</div>